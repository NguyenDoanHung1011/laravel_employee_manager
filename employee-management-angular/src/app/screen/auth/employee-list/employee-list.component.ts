import { Component, inject, signal } from '@angular/core';
import { EmployeeService } from './../../../services/employee.service';
import { MaterialModule } from '../../../material.module';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-employee-list',
  standalone: true,
  imports: [MaterialModule, RouterModule],
  templateUrl: './employee-list.component.html',
  styleUrls: ['./employee-list.component.scss'],
})
export class EmployeeListComponent {
  employees = signal<any[]>([]);
  private employeeService = inject(EmployeeService);

  constructor() {
    this.loadEmployees();
  }

  loadEmployees() {
    this.employeeService.getEmployees().subscribe((data) => this.employees.set(data));
  }

  deleteEmployee(id: number) {
    this.employeeService.deleteEmployee(id).subscribe(() => this.loadEmployees());
  }
}
