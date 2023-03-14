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
        path: '/profile/:id',
        name: 'profile',
        component: () => import("../views/profile")
    },
    {
        path: '/blogdetail/:id',
        name: 'blogdetail',
        component: () => import("../views/blogdetail")
    },
    {
        path: '/updateUser',
        name: 'updateUser',
        component: () => import("../views/updateUser")
    },
]
const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})
export default router
