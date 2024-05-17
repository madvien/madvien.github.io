<template>
    <page>
          <Panel>
             <!-- <Alert class="mb-4"/> -->
            <Form id="profile-form" @submit.prevent="onFormSubmit">
               
               <Dropdown class="mb-4" :required="true" name="type" v-model="form.job_group" :options="options.job_groups" :label="trans('profile.job_group')"/>
               <Dropdown class="mb-4" :server="'roles/search'" :server-per-page="15" :required="true" name="type" v-model="form.role" :options="options.roles" :label="trans('profile.location')"/>
               <div class="flex flex-wrap justify-between">
                    <TextInput class="mb-4 w-1/2 pr-1" type="email" :required="true" name="from" v-model="form.from" :label="trans('profile.from')"/>
                    <TextInput class="mb-4 w-1/2" type="email" :required="true" name="to" v-model="form.to" :label="trans('profile.to')"/>
               </div>
              
               <Dropdown class="mb-4" :required="true" name="type" v-model="form.schedule" :options="options.schedules" :label="trans('profile.salary_frequency')"/>
               <Dropdown class="mb-4" :server="'roles/search'" :server-per-page="15" :required="true" name="type" v-model="form.job_type" :options="options.job_types" :label="trans('profile.job_type')"/>
               <Dropdown class="mb-4" :server="'roles/search'" :server-per-page="15" :required="true" name="type" v-model="form.education" :options="options.educations" :label="trans('profile.education')"/>
               <FileInput class="mb-4" name="avatar" v-model="form.deploma" accept="image/*" :label="trans('profile.deploma')" @click="form.avatar = ''"></FileInput>
               <FileInput class="mb-4" name="avatar" v-model="form.certificate" accept="image/*" :label="trans('profile.certificate')" @click="form.avatar = ''"></FileInput>
               <TextInput class="mb-4" type="email" :required="true" name="from" v-model="form.skills" :label="trans('profile.skills')"/>
            </Form>
            <div class="text-center">
                <Button class="mr-1" type="submit" :label="trans('global.buttons.next')"/>
                <Button type="submit" :label="trans('global.buttons.next')"/>
            </div>
        </Panel>
    </page>
    
</template>

<script>
import {reactive, defineComponent} from "vue";
import {trans} from "@/helpers/i18n"
import {useAuthStore} from "@/stores";
import TextInput from "@/views/components/input/TextInput";
import Button from "@/views/components/input/Button";
import Alert from "@/views/components/Alert";


import Dropdown from "@/views/components/input/Dropdown";
import Panel from "@/views/components/Panel";
import Page from "@/views/layouts/Page";
import FileInput from "@/views/components/input/FileInput";


import Form from "@/views/components/Form";

export default defineComponent({
    name: "ProfileForm",
    components: {
        Form,
        Alert,
        Button,
        TextInput,
        Dropdown,
        FileInput
    },
    setup() {
        const authStore = useAuthStore();
        const options = reactive({
            schedules: [
                {
                    name: "monthly",
                    title: "Monthly"
                },
                {
                    name: "daily",
                    title: "Daily"
                },
                {
                    name: "hourly",
                    title: "Hourly"
                },
            ],
            job_groups: [
                {
                    name: "",
                    title: "Select"
                },
                {
                    name: "jg_1",
                    title: "House Keeping & Maintenance"
                },
                {
                    name: "jg_2",
                    title: "Personal Care"
                },
                {
                    name: "jg_3",
                    title: "Automotive Services"
                },
                {
                    name: "jg_4",
                    title: "Equipment Operation"
                },
                {
                    name: "jg_5",
                    title: "Kitchen Works"
                },
                {
                    name: "jg_6",
                    title: "Transportation"
                },
                {
                    name: "jg_7",
                    title: "Mechanic Works"
                },
                {
                    name: "jg_8",
                    title: "General Works"
                },
                {
                    name: "jg_9",
                    title: "Others"
                }
            ],
            job_types: [
                {
                    name:"all",
                    title:"All Types"
                },
                {
                    name:"full_time",
                    title:"Full Time"
                },
                {
                    name:"part_time",
                    title:"Part Time"
                },
                {
                    name:"contract_temporary",
                    title:"Contract/Temporary"
                },
                {
                    name:"casual_vacation",
                    title:"Casul/Vacation"
                },
                {
                    name:"volunteer",
                    title:"Volunteer"
                },
                {
                    name:"work_emersion_ojt",
                    title:"Work Emersion/OJT"
                }
            ],
            educations: [
                {
                    name:"elementary",
                    title:"Elementary"
                },
                {
                    name:"secondary",
                    title:"Secondary"
                },
                {
                    name:"tesda",
                    title:"Tesda"
                },
                {
                    name:"bachelor",
                    title:"Bachelor"
                },
                {
                    name:"deploma",
                    title:"Deploma"
                },
            ]
        })
        const form = reactive({
            from: 0,
            to: 0,
            role: null,
            job_group: null,
            email: null,
            deploma: null,
            certificate: null,
            schedule: null,
            
            job_type: null,
            
            education: null,
            skills: ""
            
        })

        function onFormSubmit() {
            const payload = {
                first_name: form.first_name,
                middle_name: form.middle_name,
                last_name: form.last_name,
                email: form.email,
                password: form.password,
                password_confirmation: form.passwordConfirm,
            };

            authStore.register(payload)
        }

        return {
            onFormSubmit,
            options,
            form,
            trans
        }
    }
});
</script>
