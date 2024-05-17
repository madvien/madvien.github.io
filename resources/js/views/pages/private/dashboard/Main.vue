<template>
    <Page>
        <div class="w-1/2 m-auto text-center pt-0">
            <!-- <h1 class="text-6xl mb-4 font-bold text-gray-600">Welcome</h1> -->
            <!-- <h4 class="text-gray-500 text-2xl">{{ new Date() }}</h4> -->
            <h4 class="text-gray-500 text-2xl pt-0 mt-0">Please complete your profile!</h4>
            <ProfileForm/>
        </div>
        <!-- <footer class="py-5 text-center">
            <p class="text-gray-400">{{ trans('global.phrases.inspire') }}</p>
        </footer> -->
    </Page>
</template>

<script>
import {defineComponent} from 'vue';
import {trans} from "@/helpers/i18n";
import Page from "@/views/layouts/Page";
import {default as ProfileForm} from "@/views/pages/private/dashboard/Form";

export default defineComponent({
    components: {
        Page,
        ProfileForm,
    },
    setup() {
        return {
            trans
        }
    }
});
</script>
