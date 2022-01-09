<template>
  <v-form @submit.prevent="submit">
    <v-card>
      <v-card-title>
        <span class="headline">{{ title }}</span>
      </v-card-title>
      <v-card-text>
        <v-text-field
          v-model="form.name"
          :label="$t('name') + ' *'"
          name="title"
          type="text"
          :error-messages="form.errors.get('title')"
          required
        />
      </v-card-text>
      <v-card-actions>
        <v-spacer />
        <cancel-button @click="$emit('cancel')" />
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
        name: ''
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
      console.log(this.form);
    }
  },
  methods: {
    async submit () {
      if (this.model) {
        await this.form.put(this.$api.office.url.update(this.model.id))
      } else {
        await this.form.post(this.$api.office.url.store())
      }
      // this.$toast.success(this.$t('saved'))
      this.$emit('success')
    }
  }
}
</script>
