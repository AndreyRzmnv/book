<template>
  <v-form @submit.prevent="submit">
    <v-card>
      <v-card-text>
        <v-text-field
          v-model="form.name"
          :label="$t('resources.examples.fields.name') + ' *'"
          name="title"
          type="text"
          :error-messages="form.errors.get('name')"
          required
        />
        <api-autocomplete
          v-model="form.subcategory"
          :url="$api.subcategory.url.search()"
          :label="$t('resources.examples.fields.subcategory') + ' *'"
          item-text="name"
          :error-messages="form.errors.get('subcategory_id')"
          dense
          lazy-load
        >
          
        </api-autocomplete>
        <p class="font-weight-light">
          Блоки
          <v-btn
            color="success"
            icon
            @click="addBlock()"
          >
            <v-icon dark>
              mdi-plus
            </v-icon>
          </v-btn>
        </p>

        <transition-group name="blocks" tag="div" v-if="form">
          <div
            v-for="(item, index) in form.blocks"
            :key="`block-${index}`"
          >
          <v-text-field
              v-model="item.name"
              :label="$t('resources.examples.fields.name') + ' *'"
              name="title"
              type="text"
              :error-messages="form.errors.get('blocks.' + index + '.name')"
              required
            >
              <template #append-outer>
                <v-btn
                  icon
                  color="error"
                  @click="form.blocks.splice(index, 1); form.deleting_blocks.push(item.id)"
                >
                  <v-icon>
                    mdi-minus
                  </v-icon>
                </v-btn>
              </template>
            </v-text-field>
            <v-textarea
              v-model="item.description"
              :label="$t('resources.examples.fields.description') + ' *'"
              :error-messages="form.errors.get('blocks.' + index + '.description')"
            ></v-textarea>
            <v-divider></v-divider>
          </div>
        </transition-group>

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
  name: 'ExampleForm',
  components: {
    ApiAutocomplete,
    SubmitButton,
    CancelButton
  },
  props: {
    modelId: { type: [String, Number], default: null }
  },
  data () {
    return {
      form: new Form({
        name: '',
        subcategory: null,
        blocks: [],
        deleting_blocks: [],
      }),
    }
  },
  computed: {
  },
  created () {
    if (this.modelId) {
      this.$api.example.edit(this.modelId).then(({ data }) => this.init(data));
    } else {
      this.$api.example.create().then(({ data }) => this.init(data));
    }
  },
  methods: {
    async init(data) {
      if (this.modelId) 
        this.form.fill(data.model);
      this.form.deleting_blocks = [];
    },
    addBlock(){
      this.form.blocks.push({ name: '', description: ''});
    },
    async submit () {
      this.form.subcategory_id = this.form.subcategory?.id;
      if (this.modelId) {
        await this.form.put(this.$api.example.url.update(this.modelId))
      } else {
        await this.form.post(this.$api.example.url.store())
      }
      this.$router.push({name: 'admin.examples.index'})
      this.$toastr.s(this.$t('saved'))
      this.$emit('success')
    }
  }
}
</script>
