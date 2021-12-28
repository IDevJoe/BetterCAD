export default {
    "General": {
        "Branding": {
            BRAND_ICON_FILE: {
                type: "file",
                text: "Logo Image",
                description: "Replaces all instances of the BetterCAD logo with this image"
            }
        },
        "User-related Settings": {
            ALLOW_SELF_REGISTRATION: {
                "default": false,
                type: "switch",
                text: "Allow self registration",
                description: "Allows users to self register. A set of default permissions will be automatically granted."
            }
        },
    },
    "Discord": {
        "Login": {
            DISCORD_OAUTH_ENABLED: {
                "default": false,
                type: "switch",
                text: "Enable Discord Login",
                description: "Enables users to login via Discord."
            },
            DISCORD_OAUTH_FORCE: {
                "default": false,
                type: "switch",
                text: "Force Discord Login",
                description: "Only allows users to login/register through Discord login. For this to work properly, you should enable self registration."
            },
            DISCORD_OAUTH_CLIENT_ID: {
                type: "text",
                text: "Client ID",
                description: "Client ID as found on discord.com/developers"
            },
            DISCORD_OAUTH_CLIENT_SECRET: {
                type: "password",
                text: "Client Secret",
                description: "Client secret as found on discord.com/developers"
            }
        },
        "Role Sync": {
            DISCORD_ROLE_SYNC_ENABLED: {
                "default": false,
                type: "switch",
                text: "Enable Role Sync",
                description: "Enables Discord role sync. Login must be enabled already."
            }
        }
    }
}
