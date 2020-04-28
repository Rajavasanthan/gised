import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Configurations } from '../config/configurations';

@Injectable({
  providedIn: 'root'
})
export class ServerCallService {

  constructor(private http: HttpClient) {

  }

  sendToServer(request) {
    return this.http.post(Configurations.SERVER_PATH, JSON.stringify({'request':this.encryption(request)}));
  }

  sendToServer1(request) {
    return this.http.post(Configurations.SERVER_PATH_UPLOAD, request);
  }

  encryption(plainData) {
    return btoa(JSON.stringify(plainData));
  }

  decryption(encrytedData) {
    return atob(encrytedData);
  }
}
