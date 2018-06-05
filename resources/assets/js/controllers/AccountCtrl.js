import { AccountService } from '../services';

class AccountCtrl {
    constructor($scope, $window) {
        this.doLogin = this.doLogin.bind(this);
        this.$window = $window;
    }

    doLogin(event, data) {
        event.preventDefault();
        AccountService.login(data).then((response) => {
            if (response.data) {
                swal({
                    icon: 'success',
                    title: 'Success login'
                });
                setTimeout(() => {
                    this.$window.location = 'http://localhost:9090';
                }, 3000);
            } else {
                swal({
                    icon: 'warning',
                    title: "failed login"
                })
            }
        })   
    }
}

export { AccountCtrl }