<template>
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label">Order Details
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Order Status</th>
                            <th class="text-center">Type</th>
                            <th>Payment Status</th>
                            <th>Payment Method</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(order, i) in orders?.orders?.data" :key="`single-order-${i}`">
                            <td>{{ i + 1 }}</td>
                            <td>{{ order.customer?.full_name }}
                                <!-- <div>
                                    <img src="" alt=""/>
                                    <div>
                                        <h5 class="fw-bold"></h5>
                                        <p>{{  order?.customer?.email }}</p>
                                        <p>{{  order?.customer?.phone }}</p>
                                    </div>
                                </div> -->
                            </td>
                            <td>{{ order.grand_total }} $</td>
                            <td class="text-center">
                                <span class="badge bg-primary text-capitalize">{{ order?.order_status }}</span>
                            </td>
                            <td>{{ order?.order_type }}</td>
                            <td class="text-center">
                                <span class="badge bg-info text-capitalize">
                                    {{ order?.payment_status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="text-capitalize">{{ order?.payment_method }} </span>
                            </td>
                            <td>{{ order?.order_date }}</td>
                            <td>
                                <a href="#" @click="showSingleOrder(order)">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Navigation/Exchange.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1"/>
                                                <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1"/>
                                                <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </a>

                                <!--                            {name:'ShowOrderDetails', params:{id:order.id} }-->
                                <a :href="`http://localhost:5173/order-invoice/${order?.id}`" target="_blank"
                                    class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </span>
                                </a>

                                <button  @click="deleteOrder(order.id)" class="btn btn-sm btn-clean btn-icon"
                                    title="Delete">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--end: Datatable-->
                <Pagination  @some-event="allOrder" :links="orders?.orders?.links" :from="orders?.orders?.from" :to="orders?.orders?.to" :total="orders?.orders?.total" :notShowNumber="false"/>

            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card invoice-preview-card shadow-none py-5">
                        <div class="card-body invoice-padding pb-0 mb-5">
                            <div class="d-flex align-items-center justify-content-between">
                                <div style="text-align:left; max-width: 35%">
                                    <div>
                                        <div class="logo-wrapper mb-5">
                                            <img src="@/assets/images/logos/logo.png" alt="" height="40">
                                        </div>
                                        <h3 class="mt-1 fw-semibold fs-3 mb-3 text-capitalize">Invoice To: </h3>
                                        <p class="card-text mb-0 pb-0" v-if="orderDetails?.customer?.full_name">Name:
                                            <strong>{{
                                                orderDetails?.customer?.full_name }}</strong>
                                        </p>
                                        <p class="card-text mb-0 pb-0" v-if="orderDetails?.address?.phone || orderDetails?.customer?.phone">Phone: {{
                                            orderDetails?.address?.phone ?? orderDetails?.customer?.phone}}</p>
                                        <p class="card-text mb-0 pb-0" v-if="orderDetails?.address?.email || orderDetails?.customer?.email">Email: {{
                                            orderDetails?.address?.email ?? orderDetails?.customer?.email}}</p>
                                        <p class="card-text mb-0 pb-0" v-if="orderDetails?.address?.address || orderDetails?.customer?.address">Address: {{
                                            orderDetails?.address?.address ?? orderDetails?.customer?.address}}</p>
                                    </div>
                                </div>
                                <div style="text-align: right">
                                    <div class="mt-md-0 mt-2">
                                        <h4 class="invoice-title">
                                            Invoice
                                            <span class="invoice-number">#5433</span>
                                        </h4>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Order Date: {{ orderDetails?.order_date }}</p>
                                        </div>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title text-capitalize">Order Status: <span
                                                    class="badge bg-info ms-1">{{ orderDetails?.order_status }}</span></p>
                                        </div>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title text-capitalize">Payment Status: <span
                                                    class="badge bg-info ms-1">{{ orderDetails?.payment_status }}</span></p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                            <v-select :options="orderStatusList"
                                                      v-model="orderStatus"
                                                      class="form-control"
                                                      @update:modelValue="changeOrderStatus"
                                                      label="name"
                                                      placeholder="Select Order Status..."/>

                                        <v-select :options="paymentStatusList"
                                                  v-model="paymentStatus"
                                                  class="form-control"
                                                  @update:modelValue="changePaymentStatus"
                                                  :reduse="cat => cat?.name?.tolowerCase()"
                                                  label="name"
                                                  placeholder="Select Payment Status..."/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="invoice-spacing" />

                        <!-- Invoice Description starts -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="py-1" width="40%">Product Name</th>
                                        <th class="py-1">Price</th>
                                        <th class="py-1">size & Qty</th>
                                        <th class="py-1">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in  orderDetails?.orderdetails"
                                        :key="`single-details-item-${index}`">
                                        <td class="py-1">
                                            <a href="#" class="text-info text-capitalize">
                                                {{ item?.product?.title }}
                                            </a>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ item?.stoke?.price }} $</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">
                                                {{ item?.quantity }}
                                            </span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">
                                                {{ item?.stoke?.price * item?.quantity }} $
                                            </span> <!-- {{ $showPrice(item.product.price * item.quantity) }} -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <div class="card-body invoice-padding pb-0">
                            <div class="row invoice-sales-total-wrapper">
                                <div class="col-md-8 order-md-1  mt-md-0 mt-3">

                                </div>
                                <div class="col-md-4 d-flex justify-content-end order-md-2">
                                    <div class="invoice-total-wrapper w-100">
                                        <div class="invoice-total-item d-flex justify-content-between">
                                            <p class="invoice-total-title">Subtotal:</p>
                                            <p class="invoice-total-amount">{{ orderDetails?.sub_total }} $</p>
                                        </div>
                                        <!-- <div class="invoice-total-item d-flex justify-content-between"
                                            v-if="orderDetails?.coupon_discount">
                                            <p class="invoice-total-title">Coupon Discount:</p>
                                            <p class="invoice-total-amount"> - {{ $showPrice(orderDetails?.coupon_discount) }}</p>
                                        </div> -->
                                        <div class="invoice-total-item d-flex justify-content-between">
                                            <p class="invoice-total-title">Delivery Charge:</p>
                                            <p class="invoice-total-amount"> + {{
                                                orderDetails?.address?.order_area?.delivery_charge }} $</p>
                                        </div>


                                        <hr class="my-50" />
                                        <div class="invoice-total-item d-flex justify-content-between">
                                            <p class="invoice-total-title text-black fw-bolder">Grand Total:</p>
                                            <p class="invoice-total-amount text-black fw-bolder">{{
                                                orderDetails?.grand_total }}
                                                $</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Description ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";
import Pagination from "@/components/Pagination.vue";
// import Swal from "sweetalert2";
export default {
    name: "MangeOrder",
    components: {Pagination},
    data() {
        return {
            orders: {},
            orderDetails: {},
            user: User.userInfo(),
            orderStatusList: [
                {name: 'Pending'},
                {name: 'Received'},
                {name: 'Process'},
                {name:'Shipped'},
                {name:'Delivered'},
                {name: 'Cancel'}
            ],
            paymentStatusList: [
                {name: 'Pending'},
                {name: 'Cancelled'},
                {name: 'Paid'}
            ],

            orderStatus:null,
            paymentStatus:null
        }
    },
    methods: {
        allOrder(path) {
            this.$axios.get(path ?? '/api/admin/orders', {
                headers: {
                    'Authorization': `Bearer ${this.user?.token}`
                }
            })
            .then(res => {
                this.orders = res.data;
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                });
            });
        },

        showSingleOrder(info) {
            $('#exampleModal').modal('show');
            this.orderDetails = info;
        },

        deleteOrder(id){
            Swal.fire({
                title: 'Are You Sure!',
                text: 'you watnt to delete this?',
                icon:'warning',
                confirmButtonColor: '#ddd',
                cancelButtonColor: 'red',
                confirmButtonText: 'Delete',
                showCancelButton:true,
            }).then((result) => {
                if (result.value){
                    this.$axios.delete('/api/order/'+id)
                        .then(res => {
                            Toast.fire({
                                icon: 'success',
                                title: res.data.message
                            })
                            this.allOrder();
                        })
                        .catch(err => {
                            console.log(err.response.data)
                        })
                }
            }).catch(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'dont worry. your data is safe...'
                })
            })
        },
        changeOrderStatus(event){
            this.$axios.get(`/api/change-order-status?status=${event.name}&id=${this.orderDetails?.id}&type=order`, {
                headers: {
                    'Authorization': `Bearer ${this.user?.token}`
                }
            })
            .then(res => {
                Toast.fire({
                    icon: 'success',
                    title: "Status Updated..."
                });
                $("#exampleModal").modal('hide');
                this.allOrder();
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                });
            });
        },
        changePaymentStatus(event){
            this.$axios.get(`/api/change-order-status?status=${event.name}&id=${this.orderDetails?.id}&type=payment`, {
                headers: {
                    'Authorization': `Bearer ${this.user?.token}`
                },
            })
            .then(res => {
                Toast.fire({
                    icon: 'success',
                    title: "Status Updated..."
                });
                $("#exampleModal").modal('hide');
                this.allOrder();
            })
            .catch(err => {
                err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                });
            });
        },



        isLogined() {
            if (!User.loggedIn()) {
                this.$router.push({ name: "Login" })
            }
        }
    },
    computed: {
        totalQuantity() {
            let sum = 0;
            for (let i = 0; i < this.orders.length; i++) {
                sum += this.orders[i].quantity
            }
            return sum;
        },
        grandTotalAmount() {
            let sum = 0;
            for (let i = 0; i < this.orders.length; i++) {
                sum += this.orders[i].pay_bill
            }
            return sum;
        }
    },
    created() {
        this.isLogined();
        this.allOrder();
    },

}
</script>

<style scoped></style>
