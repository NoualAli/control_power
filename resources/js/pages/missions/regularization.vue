<template>
    <NLGrid gap="6" class="p-4 has-border-radius-1 border-1 border-solid my-6"
        :class="[{ 'border-success': regularization.is_regularized, 'border-info': !regularization.is_regularized }]">
        <NLColumn>
            <label class="label">
                Etat
            </label>
            <p class="mt-3" v-if="regularization.is_regularized">
                Levée
            </p>
            <p class="mt-3" v-else-if="regularization.is_rejected">
                Rejetée
            </p>
            <p class="mt-3" v-else-if="regularization.is_sanitation_in_progress && !regularization.is_rejected">
                En cours d'assainissement
            </p>
            <p class="mt-3" v-else>
                Non levée
            </p>
        </NLColumn>
        <NLColumn v-for="comment in regularization.comments">
            <NLGrid>
                <NLColumn>
                    <label class="label">
                        Commentaire
                    </label>
                    <div v-html="comment.content" class="mt-3"></div>
                </NLColumn>
                <NLColumn>
                    <NLFlex lgJustifyContent="between" lgAlignItems="center" alignItems="center">
                        <span>{{ comment.creator_full_name }}</span>
                        <span>{{ comment.created_at }}</span>
                    </NLFlex>
                </NLColumn>
                <NLColumn>
                    <div class="divider"></div>
                </NLColumn>
            </NLGrid>
        </NLColumn>
        <NLColumn>
            <label class="label">
                Actions engagées
            </label>
            <div v-html="regularization.action_to_be_taken" class="mt-3"></div>
        </NLColumn>
        <NLColumn v-if="regularization.media.length">
            <NLFile v-model="regularization.media_array" label="Pièces jointes" readonly isFlat />
        </NLColumn>
        <NLColumn>
            <NLFlex lgJustifyContent="between" lgAlignItems="center" alignItems="center">
                <span>{{ regularization.creator_full_name }}</span>
                <span>{{ regularization.created_at }}</span>
            </NLFlex>
        </NLColumn>

        <!-- Regularization actions -->
        <NLColumn>
            <NLFlex lgJustifyContent="between" lgAlignItems="center" alignItems="center">
                <!-- Regularization actions -->
                <NLFlex lgJustifyContent="end" lgAlignItems="center" alignItems="center">
                    <button
                        v-if="!forms.comment.is_open && !regularization.is_rejected && !forms.rejection.is_open && regularization.is_regularized && can('reject_regularization')"
                        class="btn btn-danger has-icon" @click.stop="handleForm('rejection', regularization)">
                        <i class="las la-ban"></i>
                        Rejeter
                    </button>
                    <button
                        v-if="!forms.comment.is_open && !forms.rejection.is_open && can('comment_regularization') && !(regularization.is_rejected && user().id == regularization.rejected_by_id)"
                        class="btn btn-info has-icon" @click.stop="handleForm('comment', regularization)">
                        <i class="las la-comment"></i>
                        Ajouter un commentaire
                    </button>
                </NLFlex>
            </NLFlex>
        </NLColumn>

        <NLColumn
            v-if="(forms.rejection.is_open && regularization.id == forms.rejection.regularization_id) || (forms.comment.is_open && regularization.id == forms.comment.regularization_id)">
            <div class="divider"></div>
        </NLColumn>

        <!-- Regularization rejection form -->
        <NLColumn v-if="forms.rejection.is_open && regularization.id == forms.rejection.regularization_id">
            <NLForm :action="handleRejection" :form="forms.rejection">
                <NLColumn>
                    <NLWyswyg v-model="forms.rejection.comment" name="comment" label="Commentaire"
                        placeholder="Justifié le rejet de cette régularisation" :form="forms.rejection" :length="1000"
                        label-required />
                </NLColumn>
                <NLColumn>
                    <!-- Submit Button -->
                    <NLFlex lgJustifyContent="end" gap="2">
                        <NLButton :loading="forms.rejection.busy" :loadingText="''" type="danger" label="Annuler"
                            @click="handleForm('rejection')" />
                        <NLButton :loading="forms.rejection.busy" label="Enregistrer" @click="handleRejection" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </NLColumn>

        <!-- Comment form -->
        <NLColumn v-if="forms.comment.is_open && regularization.id == forms.comment.regularization_id">
            <NLForm :action="handleComment" :form="forms.comment">
                <NLColumn>
                    <NLWyswyg v-model="forms.comment.comment" name="comment" label="Commentaire"
                        placeholder="Ajoutez votre commentaire" :form="forms.comment" :length="1000" label-required />
                </NLColumn>
                <NLColumn>
                    <!-- Submit Button -->
                    <NLFlex lgJustifyContent="end" gap="2">
                        <NLButton :loading="forms.comment.busy" :loadingText="''" type="danger" label="Annuler"
                            @click.stop="handleForm('comment')" />
                        <NLButton :loading="forms.comment.busy" label="Enregistrer" @click="handleComment" />
                    </NLFlex>
                </NLColumn>
            </NLForm>
        </NLColumn>
    </NLGrid>
</template>

<script>
import Form from 'vform';
import { user } from '../../plugins/user';
export default {
    name: 'regularization',
    props: {
        regularization: { type: [ Object, null ], required: true }
    },
    emits: [ 'success' ],
    data() {
        return {
            forms: {
                rejection: new Form({
                    comment: null,
                    regularization_id: null,
                    is_open: false,
                }),
                comment: new Form({
                    comment: null,
                    regularization_id: null,
                    is_open: false,
                }),
            },
            commentFormIsOpen: false,
        }
    },
    methods: {
        handleForm(name, regularization) {
            if (name == 'rejection') {
                this.forms.rejection.is_open = !this.forms.rejection.is_open
                this.forms.rejection.regularization_id = this.forms.rejection.is_open ? regularization.id : null
                if (!this.forms.rejection.is_open) {
                    this.forms.rejection.reset()
                }
            } else if (name == 'comment') {
                this.forms.comment.is_open = !this.forms.comment.is_open
                this.forms.comment.regularization_id = this.forms.comment.is_open ? regularization.id : null
                if (!this.forms.comment.is_open) {
                    this.forms.comment.reset()
                }
            } else {
                this.$swal.alert_error('Le formulaire ' + name + ' n\'éxiste pas')
            }
        },
        handleRejection() {
            this.$swal.confirm_update("Êtes-vous sûr de vouloir rejeter cette régularisation?").then((action) => {
                if (action.isConfirmed) {
                    this.forms.rejection.put("regularize/" + this.forms.rejection.regularization_id + '/reject')
                        .then(response => {
                            if (response.status) {
                                this.$emit('success', response)
                                this.handleForm('rejection')
                                this.$swal.toast_success(response.data.message)
                            } else {
                                this.$swal.alert_error(response.data.message)
                            }
                        }).catch(error => this.$swal.catchError(error))
                }
            })
        },
        handleComment() {
            this.forms.comment.post('regularize/' + this.forms.comment.regularization_id + '/comment').then(response => {
                if (response?.data?.status) {
                    this.$swal.toast_success(response?.data?.message)
                    this.forms.comment.reset()
                    this.handleForm('comment')
                    this.$emit('success', response)
                } else {
                    this.$swal.toast_error(response?.data?.message)
                }
            }).catch(error => {
                this.$swal.catchError(error)
            })
        },
    }
}
</script>

<style lang="scss" scoped></style>
