<script setup>
import { router, useForm } from "@inertiajs/vue3";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import { ref } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

dayjs.extend(relativeTime);

const props = defineProps(["quote"]);

const form = useForm({
  text: props.quote?.text,
});
const editing = ref(false);

const deleteQuote = (id) => {
  router.delete(route("quotes.destroy", id), {
    onSuccess: () => console.log("success"),
  });
};
</script>

<template>
  <blockquote
    class="relative py-2 pl-4 border-l-4 shadow sm:pl-6 dark:border-gray-700"
  >
    <div class="float-right mr-4">
      <Dropdown v-if="quote.user.id === $page.props.auth.user.id">
        <template #trigger>
          <button>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-4 h-4 text-gray-400"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"
              />
            </svg>
          </button>
        </template>
        <template #content>
          <button
            class="block w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100"
            @click="editing = true"
          >
            Edit
          </button>

          <button
            class="block w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100"
            @click="deleteQuote(quote.id)"
          >
            Delete
          </button>
        </template>
      </Dropdown>
    </div>

    <form
      v-if="editing"
      @submit.prevent="
        form.put(route('quotes.update', quote.id), {
          onSuccess: () => (editing = false),
        })
      "
    >
      <input
        type="text"
        class="w-full text-gray-900 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        v-model="form.text"
      />
      <InputError :message="form.errors.text" class="mt-2" />
      <div class="space-x-2">
        <PrimaryButton class="mt-4">Save</PrimaryButton>
        <button
          class="mt-4"
          @click="
            editing = false;
            form.reset();
            form.clearErrors();
          "
        >
          Cancel
        </button>
      </div>
    </form>

    <p v-else class="text-gray-800 sm:text-xl dark:text-white">
      <em>
        {{ quote.text }}
      </em>
    </p>

    <footer class="mt-4">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <img
            class="w-10 h-10 rounded-full"
            :src="quote?.user.profile_photo_url"
            alt="Image Description"
          />
        </div>
        <div class="ml-4">
          <div class="text-base font-semibold text-gray-800 dark:text-gray-400">
            {{ quote?.user.name }}
          </div>
          <div class="text-xs text-gray-500">
            {{ dayjs(quote.created_at).fromNow() }}
            <span v-if="quote.created_at !== quote.updated_at">
              &#x2022; Edited</span
            >
          </div>
        </div>
      </div>
    </footer>
  </blockquote>
</template>


