import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { Observable } from 'rxjs';
import { 
    Cliente, 
    Employee, 
    Product, 
    Sale, 
    Subscription, 
    Schedule 
} from '../interfaces/models';

@Injectable({
    providedIn: 'root'
})
export class ApiService {
    private apiUrl = environment.apiUrl;

    constructor(private http: HttpClient) {}

    // Clientes
    getClientes(): Observable<Cliente[]> {
        return this.http.get<Cliente[]>(`${this.apiUrl}/clients`);
    }

    getCliente(id: number): Observable<Cliente> {
        return this.http.get<Cliente>(`${this.apiUrl}/clients/${id}`);
    }

    createCliente(cliente: Cliente): Observable<Cliente> {
        return this.http.post<Cliente>(`${this.apiUrl}/clients`, cliente);
    }

    updateCliente(id: number, cliente: Cliente): Observable<Cliente> {
        return this.http.put<Cliente>(`${this.apiUrl}/clients/${id}`, cliente);
    }

    deleteCliente(id: number): Observable<void> {
        return this.http.delete<void>(`${this.apiUrl}/clients/${id}`);
    }

    // Productos
    getProductos(): Observable<Product[]> {
        return this.http.get<Product[]>(`${this.apiUrl}/products`);
    }

    getProducto(id: number): Observable<Product> {
        return this.http.get<Product>(`${this.apiUrl}/products/${id}`);
    }

    createProducto(producto: Product): Observable<Product> {
        return this.http.post<Product>(`${this.apiUrl}/products`, producto);
    }

    updateProducto(id: number, producto: Product): Observable<Product> {
        return this.http.put<Product>(`${this.apiUrl}/products/${id}`, producto);
    }

    deleteProducto(id: number): Observable<void> {
        return this.http.delete<void>(`${this.apiUrl}/products/${id}`);
    }

    // Ventas
    getVentas(): Observable<Sale[]> {
        return this.http.get<Sale[]>(`${this.apiUrl}/sales`);
    }

    getVenta(id: number): Observable<Sale> {
        return this.http.get<Sale>(`${this.apiUrl}/sales/${id}`);
    }

    createVenta(venta: Sale): Observable<Sale> {
        return this.http.post<Sale>(`${this.apiUrl}/sales`, venta);
    }

    // Subscripciones
    getSubscriptions(): Observable<Subscription[]> {
        return this.http.get<Subscription[]>(`${this.apiUrl}/subscriptions`);
    }

    createSubscription(subscription: Subscription): Observable<Subscription> {
        return this.http.post<Subscription>(`${this.apiUrl}/subscriptions`, subscription);
    }

    // Empleados
    getEmployees(): Observable<Employee[]> {
        return this.http.get<Employee[]>(`${this.apiUrl}/employees`);
    }

    createEmployee(employee: Employee): Observable<Employee> {
        return this.http.post<Employee>(`${this.apiUrl}/employees`, employee);
    }

    // Horarios
    getSchedules(): Observable<Schedule[]> {
        return this.http.get<Schedule[]>(`${this.apiUrl}/schedules`);
    }

    createSchedule(schedule: Schedule): Observable<Schedule> {
        return this.http.post<Schedule>(`${this.apiUrl}/schedules`, schedule);
    }
} 