<template>
    <section>
        <div class="row">
            <div class="col-md-3 d-flex flex-column gap-2">
                <div class="card cursor-pointer" :class="{ 'bg-primary text-white fw-bolder': currentTab === 'details' }"
                    @click="setActiveTab('details')">
                    <div class="card-body p-4">
                        Home Page Setting
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card" v-if="currentTab === 'details'">
                    <div class="card-header d-flex gap-2">
                        <h3 class="card-title m-0">Product Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md form-group">
                                <label>Nav Bar Categories</label>
                                <TreeCategory v-model="settings.navCats" multiple/>
                            </div>
                            <div class="col-md form-group">
                                <label>Home Cats</label>
                                <TreeCategory v-model="settings.homeCats" multiple/>
                            </div>
                        </div>
                        <button class="btn btn-primary fw-bold" @click="saveSetting">Save Setting</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script setup>
import { onMounted, ref } from "vue";
import useApi from "@/composables/useApi.js"
import TreeSelect from "@/components/TreeSelect.vue";
import TreeCategory from "@/components/TreeCategory.vue";

const { sendRequest } = useApi();

const settings = ref({
    navCats:[],
    homeCats:[]
})


const saveSetting = () =>{
    sendRequest({
        url: "/api/admin/save-setting",
        method: "POST",
        data:settings.value
    })

    Toast.fire({
        icon: 'success',
        title: "Setting Update Success..."
    });
}

const getSettings = async()=>{
    const data = await sendRequest("/api/admin/get-setting");
    settings.value = data?.bSettings
}

onMounted(async () => await getSettings())


const currentTab = ref('details')
const setActiveTab = (event) => currentTab.value = event
</script>

<style></style>
