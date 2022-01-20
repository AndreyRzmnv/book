<template>
  <v-form @submit.prevent="submit">
    <v-card>
      <v-card-title>
        <span class="headline">{{ title }}</span>
      </v-card-title>
      <v-card-text>
        <v-text-field
          v-model="form.name"
          :label="$t('resources.subcategories.fields.name') + ' *'"
          name="title"
          type="text"
          :error-messages="form.errors.get('name')"
          required
        />
        <api-autocomplete
          v-model="form.category"
          :url="$api.category.url.search()"
          :label="$t('resources.subcategories.fields.category') + ' *'"
          item-text="name"
          :error-messages="form.errors.get('category_id')"
          dense
          lazy-load
        />

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
import ApiAutocomplete from '../../../../components/Admin/ApiAutocomplete'
import SubmitButton from '../../../../components/Admin/SubmitButton'
import CancelButton from '../../../../components/Admin/CancelButton'

export default {
  name: 'SubcategoryForm',
  components: {
    ApiAutocomplete,
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
        category: null,
      }),
    }
  },
  computed: {
    title: function () {
      return this.model
        ? this.$t('resources.subcategories.titles.edit')
        : this.$t('resources.subcategories.titles.create')
    }
  },
  created () {
    if (this.model) {
      this.form.fill(this.model)
    }

  },
  methods: {
    async submit () {
      this.form.category_id = this.form.category?.id;
      if (this.model) {
        await this.form.put(this.$api.subcategory.url.update(this.model.id))
      } else {
        await this.form.post(this.$api.subcategory.url.store())
      }
      this.$toastr.s(this.$t('saved'))
      this.$emit('success')
    }
  }
}
</script>
