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
                type: "switch",
                text: "Allow self registration",
                description: "Allows users to self register without approval. This is not secure when used by itself, and should be grouped with something like Discord login. A set of default permissions will be automatically granted."
            },
            {
                name: "GLOBAL_REGISTRATION_CODE",
                type: "password",
                text: "Global Access Code",
                description: "A global code to enable users to create an account",
                hashed: true
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
                description: "Only allows users to login/register through Discord login."
            },
            {
                name: "DISCORD_SERVER_ID",
                type: "text",
                text: "Discord Server ID",
                description: "If set, registration codes will be bypassed for users who are in this Discord server"
            },
            {
                name: "DISCORD_SERVER_FORCE",
                type: "switch",
                text: "Users must be in Discord server",
                description: "When enabled, the user's servers will be checked on every login. Users not currently in the server will be rejected."
            },
            {
                name: "DISCORD_OAUTH_CLIENT_ID",
                type: "static",
                text: "Client ID",
                description: "Client ID as found on discord.com/developers. Due to security concerns, this must be set in the BetterCAD's .env file."
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
    DISCORD_ROLE_SYNC_ENABLED: "false",
    DISCORD_SERVER_FORCE: "false",
    BRAND_ICON_FILE: "/img/BetterCAD-433.png"
}
