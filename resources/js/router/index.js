import { createRouter, createWebHistory } from 'vue-router'
const routes = [
    {
        path: '/',
        name: 'login',
        component: () => import("../views/login")
    },
    {
        path: '/about',
        name: 'About',
        component: () => import("../views/about")
    },
    {
        path: '/home',
        name: 'home',
        component: () => import("../views/home")
    },
    {
        path: '/register',
        name: 'register',
        component: () => import("../views/register")
    },
    {
        path: '/profile',
        name: 'profile',
        component: () => import("../views/profile")
    }
]
const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})
export default router
