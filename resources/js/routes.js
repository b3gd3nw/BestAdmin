import Dashboard from './components/Dashboard';
import ExampleComponent from './components/ExampleComponent'

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
            component: ExampleComponent,
            meta: {
                title: 'Employee'
            }
        }
    ]
}