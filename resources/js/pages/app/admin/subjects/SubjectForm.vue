<template>
  <v-form @submit.prevent="submit">
    <v-card>
      <v-card-title>
        <span class="headline">{{ title }}</span>
      </v-card-title>
      <v-card-text>
        <v-text-field
          v-model="form.name"
          :label="$t('resources.subjects.fields.name') + ' *'"
          name="title"
          type="text"
          :error-messages="form.errors.get('name')"
          required
        />
        <v-color-picker
          v-model="form.color"
          dot-size="19"
          mode="hexa"
          swatches-max-height="250"
        ></v-color-picker>
      </v-card-text>
      
      <v-card-actions>
        <v-spacer />
        <cancel-button @cancel="$emit('cancel')" />
        <submit-button :loading="form.busy" />
      </v-card-actions>
    </v-card>
  </v-form>
</template>

<script>
import Form from 'vform'
import SubmitButton from '../../../../components/Admin/SubmitButton'
import CancelButton from '../../../../components/Admin/CancelButton'

export default {
  name: 'SubjectForm',
  components: {
    SubmitButton,
    CancelButton
  },
  props: {
    model: { type: Object, default: null }
  },
  data () {
    return {
      form: new Form({
        name: '',
        color: '',
      }),
    }
  },
  computed: {
    title: function () {
      return this.model
        ? this.$t('resources.subjects.titles.edit')
        : this.$t('resources.subjects.titles.create')
    }
  },
  created () {
    if (this.model) {
      this.form.fill(this.model)
    }

  },
  methods: {
    async submit () {
      if (this.model) {
        await this.form.put(this.$api.subject.url.update(this.model.id))
      } else {
        await this.form.post(this.$api.subject.url.store())
      }
      this.$toastr.s(this.$t('saved'))
      this.$emit('success')
    }
  }
}
</script>
