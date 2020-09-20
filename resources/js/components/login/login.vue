<template>
    <v-container>
        <ValidationObserver ref="observer" v-slot="{ validate, reset }">
            <form>

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


                <ValidationProvider v-slot="{ errors, valid }"  name="checkbox">
                    <v-checkbox
                            v-model="rememberMe"
                            :error-messages="errors"
                            value="1"
                            label="Remember Me?"
                            type="checkbox"
                    ></v-checkbox>
                </ValidationProvider>

                <v-btn class="mr-4" @click="login">Login</v-btn>
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
            email: '',
            rememberMe: null,
        }),

        methods: {
            login () {
                this.$refs.observer.validate()
                let credentials = {'email':this.email,'password':this.password}

                User.login(credentials)

            },
            clear () {
                this.email = ''
                this.password = ''
                this.rememberMe = null
                this.$refs.observer.reset()
            },
        },
    }
</script>