<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-toolbar-title v-if="Screen.gt.xs">
          SuperDogs Sanctuary
        </q-toolbar-title>
        <q-space v-else></q-space>
        <q-btn flat to="/" label="Home" />
        <q-btn flat to="/news" label="News" />
      </q-toolbar>
    </q-header>
    <q-page-container>
      <q-page>
        <router-view />
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { Screen } from "quasar";

//
</script>
