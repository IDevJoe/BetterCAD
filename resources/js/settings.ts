export default {
    "General": {
        "Branding": [
            {
                name: "BRAND_ICON_FILE",
                type: "file",
                text: "Logo Image",
                description: "Replaces all instances of the BetterCAD logo with this image"
            }
        ],
        "User-related Settings": [
            {
                name: "ALLOW_SELF_REGISTRATION",
                "default": false,
                type: "switch",
                text: "Allow self registration",
                description: "Allows users to self register. A set of default permissions will be automatically granted."
            }
        ],
    },
    "Discord": {
        "Login": [
            {
                name: "DISCORD_OAUTH_ENABLED",
                type: "switch",
                text: "Enable Discord Login",
                description: "Enables users to login via Discord."
            },
            {
                name: "DISCORD_OAUTH_FORCE",
                type: "switch",
                text: "Force Discord Login",
                description: "Only allows users to login/register through Discord login. For this to work properly, you should enable self registration."
            },
            {
                name: "DISCORD_OAUTH_CLIENT_ID",
                type: "text",
                text: "Client ID",
                description: "Client ID as found on discord.com/developers"
            },
            {
                name: "DISCORD_OAUTH_CLIENT_SECRET",
                type: "password",
                text: "Client Secret",
                description: "Client secret as found on discord.com/developers"
            }
        ],
        "Role Sync": [
            {
                name: "DISCORD_ROLE_SYNC_ENABLED",
                type: "switch",
                text: "Enable Role Sync",
                description: "Enables Discord role sync. Login must be enabled already."
            }
        ]
    }
}

export const defaults : {[key: string] : string} = {
    ALLOW_SELF_REGISTRATION: "false",
    DISCORD_OAUTH_ENABLED: "false",
    DISCORD_OAUTH_FORCE: "false",
    DISCORD_ROLE_SYNC_ENABLED: "false"
}
