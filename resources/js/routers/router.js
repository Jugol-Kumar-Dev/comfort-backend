import { createWebHistory, createRouter } from "vue-router";

import AddEmployee from "@/components/pages/employee/AddEmployee.vue";
import ManageEmployee from "@/components/pages/employee/ManageEmployee.vue";
import EditEmployee from '@/components/pages/employee/EditEmployee.vue';

import AddSupplier from '@/components/pages/supplier/Add.vue'
import EditSupplier from '@/components/pages/supplier/Edit.vue'
import ManageSupplier from '@/components/pages/supplier/Index.vue'

import ProductVariations from '@/components/pages/variations/Add.vue'
import MediVariation from '@/components/pages/variations/MediVariation.vue'

import AddExpense from '@/components/pages/expense/Add.vue'
import ManageExpense from '@/components/pages/expense/Index.vue'
import EditExpense from '@/components/pages/expense/Edit.vue'


import AddSalary from '@/components/pages/salary/Add.vue'
import ManageSalary from '@/components/pages/salary/Index.vue'
import MonthSalary from '@/components/pages/salary/MonthSalary.vue'


import FileUpload from '@/components/pages/uploadfile/UploadFile.vue';

import Dropzone from '@/components/pages/media/Dropzone.vue';

import Emp from '@/components/pages/emp/index.vue';

const routes =[
    //auth routes
    {
        path:'/login',
        name:'Login',
        component: ()=> import("@/views/Auth/Auth.vue")
    },
    {
        path:'/dashboard',
        name:'Dashboard',
        component: ()=>import("@/views/Dashboard.vue")
    },
    {
        path:'/logout',
        name:'Logout',
        component: ()=> import("@/views/Auth/Logout.vue")
    },

    //employee routes
    {
        path:'/add-employee',
        name:'AddEmployee',
        component: AddEmployee
    },
    {
        path:'/manage-employee',
        name:'ManageEmployee',
        component: ManageEmployee
    },
    {
        path:'/edit-employee/:id',
        name:'EditEmployee',
        component: EditEmployee
    },

    //supplier routes
    {
        path:'/add-supplier',
        name:'AddSupplier',
        component: AddSupplier
    },
    {
        path:'/manage-supplier',
        name:'ManageSupplier',
        component: ManageSupplier
    },
    {
        path:'/edit-supplier/:id',
        name:'EditSupplier',
        component: EditSupplier
    },

    //category routes
    {
        path:'/add-category',
        name:'AddCategory',
        component: ()=>import("@/views/category/Add.vue")
    },
    {
        path:'/manage-category',
        name:'ManageCategory',
        component: ()=>import("@/views/category/Index.vue")
    },
    {
        path:'/edit-category/:id',
        name:'EditCategory',
        component: ()=>import("@/views/category/Edit.vue")
    },

    //brand routes
    {
        path:'/add-brand',
        name:'AddBrand',
        component:  ()=>import("@/views/brand/Add.vue")
    },
    {
        path:'/manage-brand',
        name:'ManageBrand',
        component:  ()=>import("@/views/brand/Index.vue")
    },
    {
        path:'/edit-brand/:id',
        name:'EditBrand',
        component:  ()=>import("@/views/brand/Edit.vue")
    },

    //variation routes
    {
        path:'/manage-product-variations',
        name:'ProductVariations',
        component: ProductVariations
    },
    {
        path:'/medi-product-variations',
        name:'MediVariations',
        component: MediVariation
    },

    //manage product
    {
        path:'/add-product',
        name:'AddProduct',
        component: ()=> import("@/views/product/Add.vue")
    },
    {
        path:'/manage-product',
        name:'ManageProduct',
        component: ()=> import("@/views/product/Index.vue")
    },
    {
        path:'/modify-product/:id',
        name:'ModifyProduct',
        component: ()=> import("@/views/product/Modify.vue")
    },

    //expense routes
    {
        path:'/add-expense',
        name:'AddExpense',
        component: AddExpense
    },
    {
        path:'/manage-expense',
        name:'ManageExpense',
        component: ManageExpense
    },
    {
        path:'/edit-expense/:id',
        name:'EditExpense',
        component: EditExpense
    },

    //salary routes
    {
        path:'/add-salary',
        name:'AddSalary',
        component: AddSalary
    },
    {
        path:'/manage-salary',
        name:'ManageSalary',
        component: ManageSalary
    },
    {
        path:'/month-salary/:id',
        name:'MonthSalary',
        component: MonthSalary
    },


    //customer routes
    {
        path:'/add-customer',
        name:'AddCustomer',
        component: ()=>  import("@/views/customer/Add.vue")
    },
    {
        path:'/manage-customer',
        name:'ManageCustomer',
        component: ()=> import("@/views/customer/Index.vue")
    },
    {
        path:'/edit-customer/:id',
        name:'EditCustomer',
        component: ()=> import("@/views/customer/Edit.vue")
    },


    //stoke route
    {
        path:'/stoke-manage',
        name: 'StokeManage',
        component: ()=> import("@/views/product/Stoke.vue")
    },

    //pos route
    {
        path:'/pos',
        name: 'Pos',
        component: ()=>import("@/views/pos/Index.vue")
    },

    //order route

    {
        path:'/today-order',
        name:'TodayOrder',
        component: import('@/views/order/TodayOrder.vue')
    },

    {
        path:'/manage-order',
        name:'ManageOrder',
        component:  () => import('@/views/order/ManageOrder.vue')
    },
    {
        path:'/search-order',
        name:'SearchOrder',
        component: import('@/views/order/SearchOrder.vue')
    },
    {
        path:'/search-order/:id',
        name:'ShowOrderDetails',
        component: import('@/views/order/ShowOrder.vue')
    },

    // order areas
    {
        path:'/order-areas',
        name:'OrderAreas',
        component: import('@/views/OrderArea/Index.vue')
    },





    //media route
    {
        path:'/dropzone',
        name:'DropZone',
        component: Dropzone
    },
    {
        path:'/upload-multiple-file',
        name:'LiveUpload',
        component: FileUpload
    },

    // product reviews module
    {
        path:'/product-reviews',
        name:'Reviews',
        component: ()=>import("@/views/Review/Index.vue")
    },

    // product reviews module
    {
        path:'/product-questions',
        name:'Question',
        component: ()=>import("@/views/Question/Index.vue")
    },

    // email tools
    {
        path:'/email-marketing',
        name:'Email',
        component: ()=>import("@/views/Email/Panel.vue")
    },
    {
        path:'/manage-campaigns',
        name:'ManageCampaigns',
        component: ()=>import("@/views/Email/ManageCampaign.vue")
    },
    // page management
    {
        path:'/pages',
        name:'Pages',
        component: ()=>import("@/views/Pages/Index.vue")
    },
    {
        path:'/pages/create',
        name:'PageCreate',
        component: ()=>import("@/views/Pages/Create.vue")
    },

    // settings routes
    {
        path:'/setting',
        name:'Setting',
        component: ()=>import("@/views/Settings/Setting.vue")
    },
    // footer setting

    {
        path:'/setting/footer-setting',
        name:'FooterSetting',
        component: ()=>import("@/views/Settings/FooterSetting.vue")
    },
    // sliders management

    {
        path:'/sliders',
        name:'Sliders',
        component: ()=>import("@/views/Slider/Index.vue")
    },

    //emp routes
    {
        path:'/emp',
        name:'Emp',
        component: Emp
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: () => import("@/views/Error.vue")
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});




export default router;
