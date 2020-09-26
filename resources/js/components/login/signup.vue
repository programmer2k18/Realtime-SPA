<template>
    <v-container>
        <ValidationObserver ref="observer" v-slot="{ validate, reset }">
            <form>

                <ValidationProvider v-slot="{ errors }" name="name" rules="required">
                    <v-text-field
                            v-model="name"
                            :error-messages="errors"
                            label="Name"
                            type="text"
                            required
                    ></v-text-field>
                </ValidationProvider>

                <ValidationProvider v-slot="{ errors }" name="email" rules="required|email">
                    <v-text-field
                            v-model="email"
                            :error-messages="errors"
                            label="E-mail"
                            type="text"
                            required
                    ></v-text-field>
                </ValidationProvider>

                <ValidationProvider v-slot="{ errors }" name="Password" rules="required|max:15">
                    <v-text-field
                            v-model="password"
                            :error-messages="errors"
                            label="Password"
                            type="password"
                            required
                    ></v-text-field>
                </ValidationProvider>

                <ValidationProvider v-slot="{ errors }" name="Password" rules="required|max:15">
                    <v-text-field
                            v-model="password_confirm"
                            :error-messages="errors"
                            label="Confirm Password"
                            type="password"
                            required
                    ></v-text-field>
                </ValidationProvider>


                <ValidationProvider v-slot="{ errors, valid }"  name="checkbox">
                    <v-checkbox
                            v-model="rememberMe"
                            :error-messages="errors"
                            value="1"
                            label="Remember Me?"
                            type="checkbox"
                    ></v-checkbox>
                </ValidationProvider>

                <v-btn class="mr-4" @click="checkInputs" color="green">Sign Up</v-btn>

                <router-link to="/login">
                    <v-btn color="blue">Login</v-btn>
                </router-link>

                <v-btn @click="clear">Clear</v-btn>
            </form>
        </ValidationObserver>
    </v-container>
</template>

<script>
    import { required, email, max } from 'vee-validate/dist/rules'
    import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
    import axios from 'axios';
    setInteractionMode('eager')

    extend('required', {
        ...required,
        message: '{_field_} can not be empty',
    })

    extend('max', {
        ...max,
        message: '{_field_} may not be greater than {length} characters',
    })

    extend('email', {
        ...email,
        message: 'Email must be valid',
    })

    export default {
        components: {
            ValidationProvider,
            ValidationObserver,
        },
        data: () => ({
            password: '',
            password_confirm:'',
            email: '',
            name:'',
            rememberMe: null,
        }),
        created(){
            if (User.loggedIn())
                this.$router.push({name:'forum'})
        },
        methods: {
            signup () {
                let credentials = {'name':this.name,'email':this.email,
                                   'password':this.password};
                User.signup(credentials);

            },
            checkInputs(){

                this.$refs.observer.validate();
                if (this.name =='' || this.email=='' || this.password =='')
                  return;
                if (this.password !== this.password_confirm)
                {
                  alert('passwords don\'t match, Please confirm password correctly');
                  return;}
                this.signup()
                //this.$router.push({name:'forum'})

            },
            clear () {
                this.email = '';
                this.password = '';
                this.password_confirm = '';
                this.rememberMe = null;
                this.$refs.observer.reset();
            },
        },
    }
</script>