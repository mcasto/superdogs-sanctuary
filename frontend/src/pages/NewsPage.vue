<template>
  <div>
    <div v-html="store.news"></div>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();
</script>
