<template>
    <div>

        <div class="card rounded-md bg-primary mb-3">
            <div class="card-body py-4 rounded-lg ">
                <p class="p-0 m-0 text-white">
                    "Begin by specifying the campaign name, subject, and body. Then, select the desired number of emails to send in each batch for optimal distribution."
                </p>
            </div>
        </div>


        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title d-flex gap-5">
                    <h3 v-if="!loading">Add Campaign</h3>
                    <RequestLoading :isShow="loading" text="Loading....."/>
                </div>
            </div>
            <div class="card-body">
                <div class="mt-3">
                    <div class="d-flex align-items-center gap-2">
                        <h2>Select Emails</h2>
                        <strong class="text-black">({{ checkedItems.length }} selected)</strong>
                    </div>
                    <div class="mt-5">
                        <div class="d-flex align-items-center gap-3">
                            <input class="form-control" style="width: 80%" v-model="filterInput" placeholder="search..."/>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <button class="btn btn-primary" @click="selectALl">Select All</button>
                                <button class="btn btn-danger" @click="clearAll">Clear Selected</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 p-5 rounded-md d-flex align-items-center flex-wrap gap-2 emails__area">
                        <div class="d-flex single__email__body cursor-pointer" v-for="(email, i) in filterEmails" :key="i">
                            <label :for="`checkbox-${i}`" class="single__email cursor-pointer" :class="{ 'checked': checkedItems.includes(email) }">
                                {{ email }}
                                <input type="checkbox" :id="`checkbox-${i}`" :value="email" class="d-none" v-model="checkedItems">
                            </label>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="mt-3">
                            <input type="text" :disabled="loading" v-model="campaign" placeholder="Campaign Name....." class="form-control">
                            <small class="text-danger" v-if="error?.response?.data?.errors?.campaign">{{ error?.response?.data?.errors?.campaign[0]}}</small>
                        </div>

                        <div class="mt-3">
                            <input type="text" :disabled="loading" v-model="subject" placeholder="Campaign Subject....." class="form-control">
                            <small class="text-danger" v-if="error?.response?.data?.errors?.subject">{{ error?.response?.data?.errors?.subject[0]}}</small>
                        </div>

                        <div class="my-3">
                            <div class="text-area">
                                <textarea :disabled="loading" v-model="message" class="form-control" rows="7" placeholder="Campaign Body......."/>
                                <small class="text-danger" v-if="error?.response?.data?.errors?.message">{{ error?.response?.data?.errors?.message[0]}}</small>
                            </div>
                        </div>
                        <button  v-if="!loading" class="btn btn-lg btn-primary" @click="sendEmail">Send Emails</button>
                        <RequestLoading :isShow="loading" text="Loading...."/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import RequestLoading from "@/components/RequestLoading.vue";
    import {onMounted, ref, computed} from "vue";
    import useAxios from "@/composables/useApi.js";

    const {sendRequest, loading, error} = useAxios();

    const campaign = ref(null);
    const subject = ref(null);
    const message = ref(null);
    const checkedItems = ref([]);
    const allEmails = ref([])
    const filterInput = ref(null)

    const clearAll = () => checkedItems.value = []
    const isLoading = false;

    onMounted(async () => {
        const response = await sendRequest('api/get-customers-emails')
        allEmails.value = response.data
    })

    const filterEmails = computed(() => {
        if(!filterInput.value) return allEmails.value;
        return allEmails.value?.filter(item => {
            return item.includes(filterInput.value)
        })
    });


    const selectALl = () => checkedItems.value = filterEmails.value

    const sendEmail = async () => {
        error.value = null;
        const response = await sendRequest({
            url:"api/send-emails",
            method:"POST",
            data:{
                emails: checkedItems.value,
                subject: subject.value,
                message: message.value,
                campaign: campaign.value
            }
        })
        if (response.value){
            await Toast.fire({
                icon: 'success',
                title: "Campaign Delete Successfully Done..."
            })
        }
    }



</script>

<style>
.emails__area{
    max-height: 300px;
    overflow-y: scroll;
    border: 1px solid #d2d2d2;
    border-radius: 5px;
}
.single__email__body .single__email{
    border:1px solid #d2d2d2;
    border-radius: 5px;
    padding: 5px;
}

.checked {
    background-color: #3698fd;
    color: white;
    font-weight: 200;
}
</style>
