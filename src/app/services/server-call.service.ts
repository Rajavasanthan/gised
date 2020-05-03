import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Http, ResponseContentType, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

import { Configurations } from '../config/configurations';

@Injectable({
  providedIn: 'root'
})
export class ServerCallService {

  constructor(private httpClient: HttpClient, private http : Http) {

  }

  sendToServer(request) {
    return this.httpClient.post(Configurations.SERVER_PATH, JSON.stringify({'request':this.encryption(request)}));
  }

  sendToServer1(request) {
    return this.httpClient.post(Configurations.SERVER_PATH_UPLOAD, request);
  }

  downloadFile(id): Observable<Blob> {
    let options = new RequestOptions({responseType: ResponseContentType.Blob });
    return this.http.get(Configurations.SERVER_PATH_DOWNLOAD + id, options)
    .pipe(map(res => res.blob()));
  }

  encryption(plainData) {
    return btoa(JSON.stringify(plainData));
  }

  decryption(encrytedData) {
    return atob(encrytedData);
  }
}
