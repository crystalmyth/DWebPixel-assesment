<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import JobCard from '@/Components/JobCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    jobPostings: {
        type: Array,
        required: true,
    },
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <Hero />

        <!-- Job List -->
        <div class="bg-white">
            <div class="container py-5 grid grid-cols-2 gap-4">
                <!-- TODO: Add job list here -->
                 <JobCard v-for="(job, index) in jobPostings" :key="`job-card-${index}`" :job="job" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
