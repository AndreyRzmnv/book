<template>
  <v-card>
    <example-form
        :model-id="$route.params.id"
    />
  </v-card>
</template>

<script>

import ExampleForm from "./ExampleForm";

export default {
  components: {
    ExampleForm,
  },
};

</script>
