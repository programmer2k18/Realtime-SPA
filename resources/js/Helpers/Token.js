class Token {

    isValid(token){

        const payload = this.payload(token)
        if (payload){
            return payload.iss == "http://127.0.0.1:8000/api/login" ||
            "http://127.0.0.1:8000/api/signup"? true:false
        }
        return false
    }

    payload(token){
        const payload = token.split('.')[1];
        return this.decode(payload)
    }

    decode(payload) {
        if(this.isBase64Format(payload))
            return JSON.parse( atob(payload));
        return false;
    }

    isBase64Format(str){
        try {
            return btoa(atob(str)).replace(/=/g,"") === str;
        } catch (e) {
            return false;
        }
    }
}

export default Token = new Token()