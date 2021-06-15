import Dashboard from './components/Dashboard';
import Employee from './components/Employee';

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Dashboard,
            meta: {
                title: 'Dashboard'
            }
        },
        {
            path: '/employee',
            component: Employee,
            meta: {
                title: 'Employee'
            }
        }
    ]
}