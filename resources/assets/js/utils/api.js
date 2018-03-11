import axios from 'axios';

const apiClient = () => {
  const apiInfo = axios.create({
    baseURL: 'http://127.0.0.1:8000',
    timeout: 100000,
    headers: {
      xhrFields: {
        withCredentials: 'true',
      },
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Headers':
        'Origin, X-Requested-With, Content-Type, Accept',
    },
  });
  return apiInfo;
};

export default apiClient;
