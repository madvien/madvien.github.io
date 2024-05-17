<template>
    <div>
        <Panel :title="trans('users.labels.job_preference')" style="position: relative;" class="question">
        <header>
          <button class="btn" @click="initView.form_2 = !initView.form_2">
            <svg
              v-show="initView.form_2"
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M20 12H4"
              ></path>
            </svg>
            <svg
              v-show="!initView.form_2"
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
              ></path>
            </svg>
          </button>
        </header>
        <div :style="contentStyle_f2" class="content" style="overflow: hidden;">
            <Form id="profile-form" @submit.prevent="onFormSubmit">
           
               <Dropdown class="mb-4" :required="true" name="type" v-model="form_2.job_group" @click="form_2.job_group = null" :options="options.job_groups" :label="trans('profile.job_group')"/>
               <TextInput class="mb-4" :required="true" name="from" v-model="form_2.location" :label="trans('profile.location')"/>
               <div class="flex flex-wrap justify-between">
                    <TextInput class="mb-4 w-1/2 pr-1" type="number" :required="true" name="from" v-model="form_2.from" :label="trans('profile.from')"/>
                    <TextInput class="mb-4 w-1/2" type="number" :required="true" name="to" v-model="form_2.to" :label="trans('profile.to')"/>
               </div>
              
               <Dropdown class="mb-4" :required="true" name="type" v-model="form_2.schedule" :options="options.schedules" :label="trans('profile.salary_frequency')"/>
               <Dropdown class="mb-4" :required="true" name="type" v-model="form_2.job_type" :options="options.job_types" :label="trans('profile.job_type')"/>
               <Dropdown class="mb-4" :required="true" name="type" v-model="form_2.education" :options="options.educations" :label="trans('profile.education')"/>
               <FileInput class="mb-4" name="avatar" v-model="form_2.deploma" accept="image/*" :label="trans('profile.deploma')"></FileInput>
               <FileInput class="mb-4" name="avatar" v-model="form_2.certificate" accept="image/*" :label="trans('profile.certificate')"></FileInput>
               <TextInput class="mb-4" :required="true" name="from" v-model="form_2.skills" :label="trans('profile.skills')"/>
               <Button type="submit" :label="trans('global.buttons.update')"/>
            </Form>
        </div>
    </Panel>
    <Panel :title="trans('users.labels.general_settings')" style="position: relative;" class="question">
        <header>
          <button class="btn" @click="initView.form_1 = !initView.form_1">
            <svg
              v-show="initView.form_1"
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M20 12H4"
              ></path>
            </svg>
            <svg
              v-show="!initView.form_1"
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
              ></path>
            </svg>
          </button>
        </header>
        <div :style="contentStyle_f1" class="content" style="overflow: hidden;">
          <form @submit.prevent="onFormSubmit">
                <TextInput type="text" :required="true" :label="trans('users.labels.first_name')" name="first_name" v-model="form.first_name" class="mb-2"/>
                <TextInput type="text" :required="true" :label="trans('users.labels.last_name')" name="last_name" v-model="form.last_name" class="mb-2"/>
                <TextInput type="text" :label="trans('users.labels.middle_name')" name="middle_name" v-model="form.middle_name" class="mb-2"/>
                <TextInput type="email" :required="true" :label="trans('users.labels.email')" name="email" v-model="form.email" autocomplete="email" class="mb-4"/>
                <Button type="submit" :label="trans('global.buttons.update')"/>
            </form>
        </div>
        
    </Panel>
    
    </div>
</template>

<script>
import { ref, computed } from "vue";
import Form from "@/views/components/Form";
import FormPassword from "@/views/pages/private/profile/partials/FormPassword";
import FormGeneral from "@/views/pages/private/profile/partials/FormGeneral";
import UpdateForm from "@/views/pages/private/profile/partials/UpdateForm";

import AuthService from "@/services/AuthService";
import {trans} from "@/helpers/i18n";
import {defineComponent, reactive, onMounted} from "vue";
import {getResponseError} from "@/helpers/api";
import {useAuthStore} from "@/stores/auth";
import {useAlertStore} from "@/stores";
import Button from "@/views/components/input/Button";
import TextInput from "@/views/components/input/TextInput";
import Panel from "@/views/components/Panel";

import Alert from "@/views/components/Alert";
import alertHelpers from "@/helpers/alert";
import {useRouter} from "vue-router";


import Dropdown from "@/views/components/input/Dropdown";
import FileInput from "@/views/components/input/FileInput";

export default defineComponent({
    // name: "Accordion",
    components: {
        Form,
        Panel,
        Button,
        TextInput,
        FormGeneral,
        UpdateForm,
        Dropdown,
        Alert,
        FileInput
    },
    props: {
        title: String,
        info: String,
      },

    setup: function () {

        const alertStore = useAlertStore();

        alertStore.success("Please complete the form below to view job listings!");

        const router = useRouter();
        const authStore = useAuthStore();

         const form_2 = reactive( authStore.user?.meta ?? {
            from: 0,
            to: 0,
            job_group: null,
            email: null,
            deploma: null,
            certificate: null,
            schedule: null,
            job_type: null,
            education: null,
            skills: "",
            
        });


        const options = reactive({
            schedules: [
                {
                    id: "monthly",
                    name: "monthly",
                    title: "Monthly"
                },
                {
                    id: "daily",
                    name: "daily",
                    title: "Daily"
                },
                {
                    id: "hourly",
                    name: "hourly",
                    title: "Hourly"
                },
            ],
            job_groups: [
                {
                    id: "jg_1",
                    name: "jg_1",
                    title: "House Keeping & Maintenance"
                },
                {
                    id: "jg_2",
                    name: "jg_2",
                    title: "Personal Care"
                },
                {
                    id: "jg_3",
                    name: "jg_3",
                    title: "Automotive Services"
                },
                {
                    id: "jg_4",
                    name: "jg_4",
                    title: "Equipment Operation"
                },
                {
                    id: "jg_5",
                    name: "jg_5",
                    title: "Kitchen Works"
                },
                {
                    id: "jg_6",
                    name: "jg_6",
                    title: "Transportation"
                },
                {
                    id: "jg_7",
                    name: "jg_7",
                    title: "Mechanic Works"
                },
                {
                    id: "jg_8",
                    name: "jg_8",
                    title: "General Works"
                },
                {
                    id: "jg_9",
                    name: "jg_9",
                    title: "Others"
                }
            ],
            job_types: [
                {
                    id:"all",
                    name:"all",
                    title:"All Types"
                },
                {
                    id:"full_time",
                    name:"full_time",
                    title:"Full Time"
                },
                {
                    id:"part_time",
                    name:"part_time",
                    title:"Part Time"
                },
                {
                    id:"contract_temporary",
                    name:"contract_temporary",
                    title:"Contract/Temporary"
                },
                {
                    id:"casual_vacation",
                    name:"casual_vacation",
                    title:"Casul/Vacation"
                },
                {
                    id:"volunteer",
                    name:"volunteer",
                    title:"Volunteer"
                },
                {
                    id:"work_emersion_ojt",
                    name:"work_emersion_ojt",
                    title:"Work Emersion/OJT"
                }
            ],
            educations: [
                {
                    id:"elementary",
                    name:"elementary",
                    title:"Elementary"
                },
                {
                    id:"secondary",
                    name:"secondary",
                    title:"Secondary"
                },
                {
                    id:"tesda",
                    name:"tesda",
                    title:"Tesda"
                },
                {
                    id:"bachelor",
                    name:"bachelor",
                    title:"Bachelor"
                },
                {
                    id:"deploma",
                    name:"deploma",
                    title:"Deploma"
                },
            ]
        })
       

        // function onFormSubmit() {
        //     const payload = {
        //         first_name: form.first_name,
        //         middle_name: form.middle_name,
        //         last_name: form.last_name,
        //         meta: form_2
        //         // email: form.email,
        //         // password: form.password,
        //         // password_confirmation: form.passwordConfirm,
        //     };

        //     authStore.register(payload)
        // }

        const initView = reactive({
            form_1: false,
            form_2: true,
            form_3: false,
        });

        const authService = new AuthService();

        const form = reactive({
            first_name: null,
            last_name: null,
            middle_name: null,
            email: null,
        })

        onMounted(() => {
            if (!authStore.user) {
                return;
            }
            form.first_name = authStore.user.first_name;
            form.last_name = authStore.user.last_name;
            form.middle_name = authStore.user.middle_name;
            form.email = authStore.user.email;
            form.password = authStore.user.password;
            form.passwordConfirm = authStore.user.passwordConfirm;
            form.meta = authStore.user.meta;
        })

        console.log(form_2);

        function onFormSubmit() {
            const payload = {
                first_name: form.first_name,
                middle_name: form.middle_name,
                last_name: form.last_name,
                meta: form_2,
                email: form.email,
                password: form.password,
                password_confirmation: form.passwordConfirm,
            };

            authService.updateUser(payload)
                .then(() => authStore.getCurrentUser())
                .then((response) => {
                    alertStore.success(trans('global.phrases.profile_updated'));
                    initView.form_1 = false;
                    initView.form_2 = false;
                    router.push('/panel/listing/users');
                })
                .catch((error) => (alertStore.error(getResponseError(error))));
        }

        const expanded = ref(false);
        const contentStyle_f1 = computed(() => {
            return { "max-height": initView.form_1 ? "400px" : 0};
        });
        const contentStyle_f2 = computed(() => {
            return { "max-height": initView.form_2 ? "900px" : 0};
        });

        const infoStyle_f1 = computed(() => {
          return { opacity: initView.form_1 ? 1 : 0 };
        });

         const infoStyle_f2 = computed(() => {
          return { opacity: initView.form_2 ? 1 : 0 };
        });

        return {
            onFormSubmit,
            form,
            trans,
            expanded, contentStyle_f1, contentStyle_f2, initView,
            form_2,
            options
        }
    },
});

</script>

<style scoped lang="scss">
.question {
  
  margin-bottom: 1rem;
  
}
.question h4 {
  text-transform: none;
  line-height: 1.5;
}
.question p {
  color: var(--clr-grey-3);
  margin-bottom: 0;
  margin-top: 0.5rem;
}
.question header {
  display: flex;
  justify-content: space-between;
  align-items: center;
    position: absolute;
  top: 6px;
  right: 10px;
 
}
.question header h4 {
  margin-bottom: 0;
  
}
.question .whitespace-nowrap{
    padding: 0;
}

.btn {
  background: transparent;
  border-color: transparent;
  width: 2rem;
  height: 2rem;
  background: var(--clr-grey-special);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  color: var(--clr-red-special);
  cursor: pointer;
  margin-left: 1rem;
  align-self: center;
  min-width: 2rem;
  z-index: 1;
}

.question-title {
  cursor: pointer;
}

.content {
  max-height: 0;
  transition: max-height 0.2s ease-out;
}
.info {
  z-index: -1;
  opacity: 0;
  transition: opacity 0.2s ease-out;
}
</style>
