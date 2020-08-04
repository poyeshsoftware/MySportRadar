import DashboardMain from "../pages/DashboardMain";
import SportsMain from "../pages/SportsMain";
import TeamsMain from "../pages/TeamsMain";

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            component: DashboardMain,
            name: 'dashboard'
        },
        {
            path: '/sports',
            component: SportsMain,
            name: 'sports'
        },
        {
            path: '/teams',
            component: TeamsMain,
            name: 'teams'
        }
    ]
}
