class AppStorage {

    setToken(token){
        localStorage.setItem('token',token)
    }

    setUser(user){
        localStorage.setItem('user',user)
    }

    storeCredentials(token, user){
        this.setToken(token)
        this.setUser(user)
    }

    getToken(){
        return localStorage.getItem('token')
    }

    getUser(){
        return localStorage.getItem('user')
    }

    clearCredentials(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }

}

export default AppStorage = new AppStorage()