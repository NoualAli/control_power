<template>
    <ContentBody>
        <form enctype="multipart/form-data" @submit.prevent="create" @keydown="form.onKeydown($event)">
            <NLGrid gap="6" extraClass="my-4">
                <NLColumn>
                    <NLGrid>
                        <NLColumn v-if="form.type">
                            <Alert type="is-info">
                                <i class="las la-info-circle icon"></i> {{ description }}
                            </Alert>
                        </NLColumn>
                        <NLColumn lg="6">
                            <NLSelect v-model="form.type" :form="form" name="type" label="Type"
                                placeholder="Choisissez un type de bug" :options="typesList" labelRequired />
                        </NLColumn>
                        <NLColumn lg="6">
                            <NLSelect v-model="form.priority" :form="form" name="priority" label="Priorité"
                                placeholder="Choisissez un niveau de priorité" :options="prioritiesList" labelRequired />
                        </NLColumn>
                    </NLGrid>
                </NLColumn>
                <NLColumn>
                    <!-- Media (attachements) -->
                    <!-- <NLFile v-model="form.media" name="media" label="Pièces jointes" attachable-type="App\Models\Bugs"
                        :form="form" multiple accepted="jpg,jpeg,png"
                        helpText="Ajoutez des images (screenshots) pour mieux expliquer votre problème. Les types de fichier accepté sont: jpg, jpeg et png" />
                    {{ form.media }} -->
                </NLColumn>
                <!-- Code -->
                <NLColumn md="6">
                    <NLWyswyg v-model="form.description" :form="form" name="description" label="Description"
                        placeholder="Ajouter une description du bug" labelRequired />
                </NLColumn>

            </NLGrid>
            <!-- Submit Button -->
            <div class="d-flex justify-end align-center">
                <NLButton :loading="form.busy" label="Signaler" />
            </div>
        </form>
    </ContentBody>
</template>

<script>
import Alert from '../../components/Alert'
import NLGrid from '../../components/Grid/NLGrid'
import NLFile from '../../components/Inputs/NLFile'
import NLColumn from '../../components/Grid/NLColumn'
import { Form } from 'vform'

export default {
    components: {
        Alert,
        NLGrid,
        NLFile, NLColumn
    },
    layout: 'MainLayout',
    middleware: [ 'auth' ],
    data() {
        return {
            typesList: [
                {
                    id: 1,
                    label: 'Interface utilisateur (UI)',
                    description: "Ces bugs affectent principalement l'expérience utilisateur, tels que des problèmes de mise en page, des erreurs d'affichage, des boutons qui ne fonctionnent pas, etc.",
                },
                {
                    id: 2,
                    label: 'Erreur d\'exécution',
                    description: "Ces bugs surviennent lorsque le code est exécuté mais rencontre une erreur qui interrompt le flux normal du programme. Cela peut inclure des exceptions non gérées, des dépassements de capacité, des erreurs de division par zéro, etc.",
                },
                {
                    id: 3,
                    label: 'Problèmes de logique',
                    description: " Ces bugs se produisent lorsque le code est correctement exécuté mais ne produit pas les résultats attendus en raison d'une erreur de conception ou d'une mauvaise compréhension des exigences. Cela peut inclure des erreurs de calcul, des boucles infinies, des conditions mal définies, etc.",
                },
                {
                    id: 4,
                    label: 'Fuite de mémoire',
                    description: "Ces bugs se produisent lorsque la gestion de la mémoire dans le code n'est pas correctement effectuée, entraînant une utilisation excessive de la mémoire qui n'est pas libérée lorsque cela est nécessaire. Cela peut entraîner une dégradation des performances du programme ou des plantages.",
                },
                {
                    id: 5,
                    label: 'Bugs de compatibilité',
                    description: "Ces bugs se produisent lorsque le logiciel ne fonctionne pas correctement sur certains environnements, systèmes d'exploitation, navigateurs ou versions spécifiques.",
                },
                {
                    id: 6,
                    label: 'Bugs de performance',
                    description: "Ces bugs se produisent lorsque le logiciel ne répond pas aux exigences de performance, tels que des temps de réponse lents, une utilisation excessive des ressources, des problèmes de scalabilité, etc.",
                },
                {
                    id: 7,
                    label: 'Autre',
                    description: "Tout autre type de bug qui n\'est pas lister ci-dessus.",
                },
            ],
            prioritiesList: [
                {
                    id: 1,
                    label: 'Normal',
                },
                {
                    id: 2,
                    label: 'Moyenne',
                },
                {
                    id: 3,
                    label: 'Urgente',
                },
            ],
            form: new Form({
                type: null,
                priority: null,
                description: null,
                // media: null,
            }),
            originalForm: {},
        }
    },
    created() {
        this.originalForm = Object.assign({}, this.form);
    },
    beforeRouteLeave(to, from, next) {
        if (this.isFormDirty()) {
            return this.askBeforeLeave(next)
        }
        return next()
    },
    computed: {
        description() {
            return this.typesList.filter((item) => item.id == this.form.type)[ 0 ].description
        }
    },
    methods: {
        isFormDirty() {
            // Compare each form field with the originalForm values
            for (let field in this.form) {
                if (this.form[ field ] !== this.originalForm[ field ]) {
                    return true; // Form values have changed
                }
            }
            return false; // No changes in form values
        },
        create() {
            this.form.post('bugs').then(response => {
                if (response.data.status) {
                    this.$swal.toast_success(response.data.message)
                    this.form.reset()
                } else {
                    this.$swal.alert_error(response.data.message)
                }
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
