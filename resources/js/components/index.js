import Vue from 'vue'
// import Card from './Card.vue'
import Child from './Child.vue'
// import Button from './Button.vue'
// import Checkbox from './Checkbox.vue'
import Notification from './Notification.vue'
import DefaultContainer from './Inputs/DefaultContainer.vue'
import NLInput from './Inputs/NLInput.vue'
import NLTextarea from './Inputs/NLTextarea.vue'
import NLButton from './Inputs/NLButton.vue'
import NLRadio from './Inputs/NLRadio.vue'
import NLCheckbox from './Inputs/NLCheckbox.vue'
import NLSelect from './Inputs/NLSelect'
import NLCheckableContainer from './Inputs/NLCheckableContainer.vue'
import NLWyswyg from './Inputs/NLWyswyg.vue'
import NLDatatable from './NLDatatable.vue'
import { HasError, AlertError, AlertSuccess, AlertErrors } from 'vform/components/bootstrap5'
import NLModal from './NLModal'
import ContentHeader from './ContentHeader'
import ContentBody from './ContentBody'
import NLRepeater from './Inputs/NLRepeater'
import NLSwitch from './Inputs/NLSwitch'
// Components that are registered globaly.
[
  NLSwitch,
  NLRepeater,
  ContentBody,
  ContentHeader,
  NLSelect,
  NLModal,
  NLTextarea,
  DefaultContainer,
  NLDatatable,
  NLCheckableContainer,
  NLCheckbox,
  NLRadio,
  NLButton,
  NLWyswyg,
  NLInput,
  // Card,
  Child,
  // Button,
  // Checkbox,
  HasError,
  // AlertError,
  // AlertSuccess,
  Notification,
  AlertErrors
].forEach(Component => {
  Vue.component(Component.name, Component)
})
