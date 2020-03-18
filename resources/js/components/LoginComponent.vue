<template>
    <v-app id="inspire">
        <v-content>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col
                        cols="12"
                        sm="8"
                        md="4"
                    >
                        <v-card class="elevation-12">
                            <v-toolbar
                                color="error"
                                dark
                                flat
                            >
                                <v-toolbar-title>Login form</v-toolbar-title>
                                <v-spacer/>

                            </v-toolbar>
                            <v-card-text>
                                <v-progress-linear
                                    :active="loading"
                                    :indeterminate="loading"
                                    absolute
                                    bottom
                                    color="deep-purple accent-4"
                                ></v-progress-linear>
                                <v-form>
                                    <v-text-field
                                        label="Login"
                                        name="login"
                                        v-model="email"
                                        prepend-icon="mdi-microsoft-access"
                                        type="text"
                                    />

                                    <v-text-field
                                        id="password"
                                        label="Password"
                                        name="password"
                                        v-model="password"
                                        prepend-icon="mdi-lock-check"
                                        type="password"
                                    />
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer/>
                                <v-btn color="error" v-on:click="login">Login</v-btn>
                            </v-card-actions>
                        </v-card>
                        <v-snackbar v-model="snackbar" >
                            {{ snakbarText }}
                            <v-btn
                                color="pink"
                                text
                                @click="snackbar = false"
                            >
                                Close
                            </v-btn>
                        </v-snackbar>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        data(){
            return {
                email:'',
                password: '',
                loading: false,
                snackbar: false,
                snakbarText: ""

            }
        },
        methods:{
            login: function(){
                // Add a request interceptor
                axios.interceptors.request.use( (config) => {
                    this.loading = true;
                    // Do something before request is sent
                    return config;
                }, function (error) {
                    this.loading = false;
                    return Promise.reject(error);
                });

// Add a response interceptor
                axios.interceptors.response.use( (response) => {
                    this.loading = false;
                    // Any status code that lie within the range of 2xx cause this function to trigger
                    // Do something with response data
                    return response;
                },  (error) => {
                    this.loading = false;
                    // Any status codes that falls outside the range of 2xx cause this function to trigger
                    // Do something with response error
                    return Promise.reject(error);
                });
                axios.post('/api/login',{
                    'email':this.email,
                    'password': this.password
                })
                .then(res => {

                    this.snakbarText = res.data.token;
                    this.snackbar = true;

                    localStorage.setItem('token',res.data.token);
                }).catch(err => {
                    this.snakbarText = err.response.data.message;
                    this.snackbar = true;
                });
            }

        }

    }
</script>
<style scoped></style>
