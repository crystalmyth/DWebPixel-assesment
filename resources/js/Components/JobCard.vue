<template>
  <div class="bg-white shadow rounded-md p-4 mb-4">
    <div class="flex items-start justify-between">
      <div class="flex items-center">
        <div v-if="job.company_logo" class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-2">
          <img :src="isUrl(job.company_logo) ? job.company_logo : `/storage/${job.company_logo}`"
            :alt="`${job.company_name} Logo`" class="w-full h-full object-contain rounded-full" />
        </div>
        <div v-else class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-2">
          {{ job.company_name.substring(0, 1).toUpperCase() }}
        </div>
        <div>
          <h2 class="text-lg font-semibold text-gray-900">{{ job.title }}</h2>
          <p class="text-sm text-gray-600">{{ job.company_name }}</p>
        </div>
      </div>
      <div v-if="job.extra" class="flex items-center space-x-2">
        <span v-for="et in job.extra"
          class="inline-flex items-center bg-gray-300 text-gray-800 text-xs font-medium rounded-full px-2 py-0.5">{{ et
          }}</span>
      </div>
    </div>
    <div class="mt-2 flex flex-wrap items-center space-x-4 text-sm text-gray-500">
      <div class="flex items-center gap-1">
        <Icon name="briefcase" class="h-5" />
        <span class="block">{{ job.experience }}</span>
      </div>
      <div class="flex items-center gap-1">
        <Icon name="rupee" />
        {{ job.salary }}
      </div>
      <div class="flex items-center gap-1">
        <Icon name="location" class="h-5" />
        {{ job.location }}
      </div>
    </div>
    <p class="mt-3 text-gray-700 text-sm leading-relaxed flex gap-2 items-start">
      <Icon name="file" class="h-10" />
      <span>
        {{ truncateDescription(job.description, 150) }}
      </span>
    </p>
    <div class="mt-2">
      <span v-for="(skill, index) in job.skills" :key="skill"
        class="inline-flex items-center text-gray-500 text-xs font-medium rounded-full px-2 py-0.5 relative">
        {{ skill }}
        <span v-if="index < job.skills.length - 1"
          class="absolute -right-1 top-1/2 -translate-y-1/2 w-1 h-1 rounded-full bg-gray-500"></span>
      </span>
    </div>
    <div class="mt-2 text-xs text-gray-500 flex justify-end">
      {{ job.created_ago }}
    </div>
  </div>
</template>

<script setup>
import Icon from './Icon.vue';

const props = defineProps({
  job: {
    type: Object,
    required: true,
  },
})

const isUrl = (path) => {
  try {
    new URL(path);
    return true;
  } catch (e) {
    return false;
  }
}

const truncateDescription = (text, length) => {
  if (text.length > length) {
    return text.substring(0, length) + '...';
  }
  return text;
}
</script>