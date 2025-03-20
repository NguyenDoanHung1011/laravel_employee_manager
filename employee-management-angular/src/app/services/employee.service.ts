import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {
  private apiUrl = 'http://127.0.0.1:8000/api/users';

  constructor(private http: HttpClient) {}

  private getHeaders() {
    return {
      headers: new HttpHeaders().set('Authorization', `Bearer ${localStorage.getItem('token')}`)
    };
  }

  getEmployees(): Observable<any> {
    return this.http.get(this.apiUrl, this.getHeaders());
  }

  getEmployee(id: number): Observable<any> {
    return this.http.get(`${this.apiUrl}/${id}`, this.getHeaders());
  }

  createEmployee(employee: any): Observable<any> {
    return this.http.post(this.apiUrl, employee, this.getHeaders());
  }

  updateEmployee(id: number, employee: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/${id}`, employee, this.getHeaders());
  }

  deleteEmployee(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${id}`, this.getHeaders());
  }
}
