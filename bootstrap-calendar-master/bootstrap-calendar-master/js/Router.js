class Router {
    constructor(routes) {
      this.routes = routes;
    }
  
    navigateTo(path) {
      let matchedRoute = this.routes.find((route) => {
        if (typeof route.path === 'string') {
          return route.path === path;
        } else if (route.path instanceof RegExp) {
          return route.path.test(path);
        }
        return false;
      });
  
      if (matchedRoute) {
        matchedRoute.handler();
      } else {
        // Handle 404 - Page not found
        console.log('404 - Page not found');
      }
    }
  }
  
  // Example routes
  const routes = [
    {
      path: '/',
      handler: () => {
        console.log('Home page');
        // Render home page component
      },
    },
    {
      path: '/calendar',
      handler: () => {
        console.log('Calendar page');
        // Render calendar component
      },
    },
    {
      path: /^\/event\/(\d+)$/,
      handler: (eventId) => {
        console.log(`Event page with ID: ${eventId}`);
        // Render event component with eventId
      },
    },
  ];
  
  // Create router instance
  const router = new Router(routes);
  
  // Simulate navigation
  router.navigateTo('/'); // Home page
  router.navigateTo('/calendar'); // Calendar page
  router.navigateTo('/event/123'); // Event page with ID: 123
  router.navigateTo('/invalid'); // 404 - Page not found