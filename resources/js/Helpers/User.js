import Token from './Token.js'
import AppStorage from './AppStorage.js'

class User {

    login(credentials){

        axios.post('/api/login',credentials)
            .then( res=>this.responseAfterLogin(res) )
            .catch(error=>alert('Something went wrong, Please try again'))
    }

    signup(credentials){

        axios.post('/api/signup',credentials)
            .then( res=>this.responseAfterLogin(res) )
            .catch(error=>alert('Something went wrong, Please try again'))
    }

    responseAfterLogin(res){

        if (Token.isValid(res.data.access_token)) {
            AppStorage.storeCredentials(res.data.access_token, res.data.user.id);
            window.location='/forum';
        }
    }

    hasToken(){

        const storedToken = AppStorage.getToken()
        if (storedToken){
            return Token.isValid(storedToken)? true:this.logout()
        }
        return false
    }

    loggedIn(){ return this.hasToken() }

    logout() { AppStorage.clearCredentials(); window.location ='/forum'; }

    userData(){ return AppStorage.getUser() }

    ownsTheQuestion(user_id){
        return this.userData() == user_id;
    }

    isAdmin(){return this.userData() == 106;}
}

export default User = new User()