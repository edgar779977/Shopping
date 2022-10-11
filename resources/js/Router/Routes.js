// import auth from './middleware/auth';
// import unauthorized from "./middleware/unauthorized"

const routes = [
    {
        path: '/login',
        name: 'login',
        meta: {
            // middleware: unauthorized
        },
        component: () => import('../pages/login')
    },
    {
        path: '/',
        name: 'home',
        meta: {
            // middleware: auth
        },
        component: () => import('../pages/index')
    },
    {
        path: '/search',
        name: 'search',
        meta: {
            // middleware: auth
        },
        component: () => import('../pages/search')
    },
    {
        path: '/signUp',
        name: 'signUp',
        meta: {
            // middleware: auth
        },
        component: () => import('../pages/signUp')
    },
]

export default routes
