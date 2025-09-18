import 'vue'
import { Config, RouteParam, RouteParamsWithQueryOverload } from 'ziggy-js'

declare module 'vue' {
  interface ComponentCustomProperties {
    route: (
      name: string,
      params?: RouteParamsWithQueryOverload | RouteParam,
      absolute?: boolean,
      config?: Config
    ) => string & { current: (name: string, params?: RouteParam) => boolean }
  }
}
