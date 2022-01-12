<template>
  <v-btn
    v-bind="$attrs"
    type="submit"
    color="success"
    v-on="$listeners"
  >
    {{ $t('save') }}
  </v-btn>
</template>

<script>

export default {
  name: 'SubmitButton'
}
</script>
