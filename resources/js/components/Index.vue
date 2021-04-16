<template>
    <div id="main">
        <header>
            <div>
                <b-navbar toggleable="lg" type="dark" variant="info">
                    <b-navbar-brand href="#">Propetry</b-navbar-brand>

                    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                    <b-collapse id="nav-collapse" is-nav>

                        <!-- Right aligned nav items -->
                        <b-navbar-nav  class="ml-auto">
                            <b-nav-form v-if="!user.token" right>
                                <div>
                                    <b-form-input
                                        v-model="loginEmail"
                                        type="email"
                                        id="inline-form-input-name"
                                        class="mb-2 mr-sm-2 mb-sm-0"
                                        placeholder="Email"
                                    ></b-form-input>
                                    <b-form-text id="name-help-block">
                                        admin@test.com
                                    </b-form-text>
                                </div>
                                <div>
                                    <b-form-input
                                        v-model="loginPassword"
                                        type="password"
                                        id="inline-form-input-password"
                                        aria-describedby="password-help-block"
                                        placeholder="Password"
                                    >
                                    </b-form-input>
                                    <b-form-text id="password-help-block">
                                        password
                                    </b-form-text>
                                </div>
                                <div>
                                    <b-button v-on:click="login" variant="primary">Login</b-button>
                                    <b-form-text id="button-help-block">
                                        <span style="color: #1a202c00">1</span>
                                    </b-form-text>
                                </div>

                            </b-nav-form>

                            <b-nav-item-dropdown v-if="user.token" right>
                                <!-- Using 'button-content' slot -->
                                <template #button-content>
                                    <em>User</em>
                                </template>
                                <b-dropdown-item><b-button v-on:click="logout" variant="danger">Log Out</b-button></b-dropdown-item>

                            </b-nav-item-dropdown>
                        </b-navbar-nav>
                    </b-collapse>
                </b-navbar>
            </div>
        </header>
        <section>
                <div class="container">
                    <div class="row pb-3 pt-3">
                        <b-form inline>
                            <b-input-group class="mb-2 mr-sm-2 mb-sm-0" prepend="Name" >
                                <b-form-input
                                    v-model="form.name"
                                    id="inline-form-input-name"
                                    class="mb-2 mr-sm-2 mb-sm-0"
                                ></b-form-input>
                            </b-input-group>

                            <b-input-group class="mb-2 mr-sm-2 mb-sm-0" prepend="Price" >
                                <b-form-input
                                    v-model="form.price_min"
                                    aria-label="min"
                                    placeholder="Min"
                                    type="number"
                                    min="0"
                                ></b-form-input>
                                <b-form-input
                                    v-model="form.price_max"
                                    aria-label="max"
                                    placeholder="Max"
                                    type="number"
                                    min="0"
                                ></b-form-input>
                            </b-input-group>

                            <b-input-group class="mb-2 mr-sm-2 mb-sm-0" prepend="Bedrooms" >
                                <b-form-input
                                    v-model="form.bedrooms"
                                    id="inline-form-input-bedrooms"
                                    type="number"
                                    min="0"
                                    class="mb-2 mr-sm-2 mb-sm-0"
                                ></b-form-input>
                            </b-input-group>

                            <b-input-group class="mb-2 mr-sm-2 mb-sm-0" prepend="Bathrooms" >
                                <b-form-input
                                    v-model="form.bathrooms"
                                    id="inline-form-input-bathrooms"
                                    type="number"
                                    min="0"
                                    class="mb-2 mr-sm-2 mb-sm-0"
                                ></b-form-input>
                            </b-input-group>

                            <b-input-group class="mb-2 mr-sm-2 mb-sm-0" prepend="Storeys" >
                                <b-form-input
                                    v-model="form.storeys"
                                    id="inline-form-input-storeys"
                                    type="number"
                                    min="0"
                                    class="mb-2 mr-sm-2 mb-sm-0"
                                ></b-form-input>
                            </b-input-group>

                            <b-input-group class="mb-2 mr-sm-2 mb-sm-0" prepend="Garages" >
                            <b-form-input
                                v-model="form.garages"
                                id="inline-form-input-garages"
                                type="number"
                                min="0"
                                class="mb-2 mr-sm-2 mb-sm-0"
                            ></b-form-input>
                            </b-input-group>
                            <b-form-group class="mb-2 mr-sm-2 mb-sm-0">
                                <b-button v-on:click="fetch" variant="primary">Search</b-button>
                            </b-form-group>
                        </b-form>
                    </div>
                    <div class="row pb-3 pt-3">
                        <b-table
                            :items="items"
                            :fields="fields"
                        ></b-table>
                        <div class="mt-3">
                            <b-pagination
                                v-model="form.page"
                                :total-rows="rows"
                                :per-page="perPage"
                                first-number
                                last-number
                                @change="handlePageChange"
                            ></b-pagination>
                        </div>
                    </div>

                </div>
        </section>
    </div>
</template>
<script>

import axios from "axios";

export default {
    data() {
        return {
            loginEmail:'admin@test.com',
            loginPassword:'password',
            user:[],

            //table
            fields: [
                'id',
                'name',
                'price',
                'bedrooms',
                'bathrooms',
                'storeys',
                'garages'
            ],
            items: [
            ],

            rows: 1,
            perPage: 1,

            //filter
            form: {
                name: null,
                price_min: null,
                price_max: null,
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null,
                page: 1
            },

        }
    },
    methods: {
        login: function (event) {
            return axios.post("api/v1/login",{
                email: this.loginEmail,
                password: this.loginPassword
            })
                .then(response => {
                    this.user = response.data.result
                    console.log(this.user)
                    this.fetch()
                })
                .catch(err => {
                    if (err.response.status === 401){
                        alert(err.response.data.message)
                    }
                })
        },
        logout: function (event) {
            return axios.get("api/v1/logout",{
                headers: {
                    'Authorization': `Bearer ${this.user.token}`
                }
            })
                .then(response => {
                    this.user = []
                    this.items = []
                })
                .catch(err => {
                    console.log(err)
                })
        },
        fetch: function (event){
console.log(this.form)
            axios.get(`api/v1/property`,
                {
                    params: this.form,
                    headers: {
                        'Authorization': `Bearer ${this.user.token}`
                    }
                })
                .then(response => {
                    this.items = response.data.result.data
                    this.perPage = response.data.result.pagination.per_page
                    this.rows = response.data.result.pagination.total_pages
                    this.currentPage = response.data.result.pagination.current_page


                    console.log(response.data.result)
                })
                .catch(err => {
                    if (err.response.status === 401){
                        alert(err.response.data.message)
                    }
                })
        },
        handlePageChange(value){
            this.form.page = value
            this.fetch()
        }
    }
}
</script>
