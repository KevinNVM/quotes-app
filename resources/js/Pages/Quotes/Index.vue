<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Quote from "../../Components/Quote.vue";
import NewQuoteForm from "../../Components/NewQuoteForm.vue";

const props = defineProps(["quotes"]);
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        All Quotes
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto mb-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 pt-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
          <NewQuoteForm />
        </div>
      </div>
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
          <h3 class="mb-4 text-lg">Menampilkan {{ quotes.length }} Quotes</h3>

          <section v-if="quotes.length > 0" id="quote-list" class="grid gap-8">
            <Quote v-for="(quote, i) in quotes" :key="i" :quote="quote" />
          </section>
          <section v-else>
            <h2 class="text-lg text-gray-500">
              Tidak ada Quotes, Cobalah membuat quote
            </h2>
          </section>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
