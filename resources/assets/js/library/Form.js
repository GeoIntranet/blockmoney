class Errors{

    constructor(){
        this.errors = {}
    }

    get(field){
        if(this.errors[field]){
            return this.errors[field][0] ;
        }
    }

    record(errors){
        this.errors = errors;
    }

    clear(field){
        if(field) delete this.errors[field];
        delete this.errors[field];
    }

    has(field){
        return this.errors.hasOwnProperty(field);
    }

    any(){
        return Object.keys(this.errors).length > 0;
    }
}

class Form {

    constructor(data){
        this.originalData =data;

        for (let field in data){
            this[field]= data[field];
        }

        this.errors = new Errors();
    }
    data(){
        let data = Object.assign({}, this);

        delete data.originalData;
        delete data.errors;

        return data;
    }
    reset(){
        for(let field in this.originalData){
            this[field] = '';
        }
        this.errors.clear();
    }
    submit(requestType, url)
    {
        return new Promise((resolve,reject) => {
            axios[requestType]( url, this.data() )
                .then(response => {
                    this.onSucess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data);

                    reject(error.response.data);
                });
        });

    }
    onSucess(response){
        alert(response.message);
        this.reset();
    }
    onFail(errors){
        this.errors.record(errors)
    }
}