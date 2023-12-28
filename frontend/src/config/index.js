import BaseConfig from "./config.base"
import ProdConfig from "./config.prod"
import DevConfig from "./config.dev"

let ExtraConfig = ProdConfig

if (BaseConfig.env === "development" || BaseConfig.env === "dev") {
  console.log("running in dev mode")
  ExtraConfig = DevConfig
}

const Config = { ...BaseConfig, ...ExtraConfig }

export default Config