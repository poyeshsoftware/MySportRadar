import DashboardMain from "../pages/DashboardMain";
import SportsMain from "../pages/SportsMain";
import TeamsMain from "../pages/TeamsMain";
import AddEditEvent from "../pages/AddEditEvent";
import AddSport from "../pages/AddSport";
import AddTeam from "../pages/AddTeam";

export default {
    mode: 'history',
    routes: [
        {
            path: '/dashboard',
            component: DashboardMain,
            name: 'dashboard'
        }, {
            path: '/dashboard/events/add',
            component: AddEditEvent,
            name: 'add_event'
        }, {
            path: '/dashboard/events/edit/:id',
            component: AddEditEvent,
            name: 'edit_event',
            props: true
        },
        {
            path: '/dashboard/sports',
            component: SportsMain,
            name: 'sports'
        },
        {
            path: '/dashboard/sports/add',
            component: AddSport,
            name: 'add_sport'
        }, {
            path: '/dashboard/sports/edit/:id',
            component: AddSport,
            name: 'edit_sport',
            props: true
        },
        {
            path: '/dashboard/teams',
            component: TeamsMain,
            name: 'teams'
        }, {
            path: '/dashboard/teams/add',
            component: AddTeam,
            name: 'add_team'
        }, {
            path: '/dashboard/teams/edit/:id',
            component: AddTeam,
            name: 'edit_team',
            props: true
        }
    ]
}
