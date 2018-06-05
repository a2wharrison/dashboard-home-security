import $  from 'jquery';
const BaseUrl = 'http://localhost:9090';
import axios from 'axios';
let headers = { 'Content-Type': 'application/json' };


export const AccountService = {
  login
}

function login(data) {
  let request = axios.post(BaseUrl+ '/doLogin', data);
  return (request.then(handleSuccess, handleError));
}


function handleError( response ) {
  if (! _.isObject( response.data ) || ! response.data.message) {
    return( Promise.reject( "An unknown error occurred." ) );
  }

  return( Promise.reject( response.data.message ) );
}

function handleSuccess( response ) {
  return( response.data );
}
