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
                description: "Allows users to self register using an access code. An admin will still need to grant permissions to the user."
            },
            {
                name: "GLOBAL_REGISTRATION_CODE",
                type: "password",
                text: "Global Access Code",
                description: "A global code to enable users to create an account",
                hashed: true
            }
        ],
        "Manifest": [
            {
                name: "MANIFEST",
                type: "file",
                text: "Custom Manifest Upload",
                description: "A manifest includes additional features, such as address autocompletion. It also includes several lists (like vehicles) to be used for forms. See the wiki on details on how to edit this file."
            }, {
                name: "CIV_VEH_MAKE_MODEL_USE_MANIFEST",
                type: "switch",
                text: "Use vehicles from the manifest",
                description: "Disables user-supplied vehicle make/models and replaces it with a dropdown with values from the manifest"
            }
        ]
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
    },
    "10 Codes": {
        "Duty Statuses": [
            {
                name: "LANG_10C_BEGIN_DUTY",
                type: "text",
                text: "Beginning of Duty"
            },
            {
                name: "LANG_10C_END_DUTY",
                type: "text",
                text: "End of Duty"
            }
        ],
        "Patrol Statuses": [
            {
                name: "LANG_10C_AVAIL",
                type: "text",
                text: "Available"
            },
            {
                name: "LANG_10C_OFF_DUTY",
                type: "text",
                text: "Off Duty"
            },
            {
                name: "LANG_10C_BUSY",
                type: "text",
                text: "Busy"
            }
        ],
        "Call Statuses": [
            {
                name: "LANG_10C_ENROUTE",
                type: "text",
                text: "Enroute"
            },
            {
                name: "LANG_10C_ON_SCENE",
                type: "text",
                text: "On Scene"
            },
            {
                name: "LANG_10C_TRANSPORT",
                type: "text",
                text: "Transport"
            }
        ],
        "Signals": [
            {
                name: "LANG_10C_EMERGENCY_TFC",
                type: "text",
                text: "Emergency Traffic Only"
            },
            {
                name: "LANG_10C_STOP_TX",
                type: "text",
                text: "Stop Transmitting"
            },
        ]
    }
}

export const defaults : {[key: string] : string} = {
    ALLOW_SELF_REGISTRATION: "false",
    DISCORD_OAUTH_ENABLED: "false",
    DISCORD_OAUTH_FORCE: "false",
    DISCORD_ROLE_SYNC_ENABLED: "false",
    DISCORD_SERVER_FORCE: "false",
    BRAND_ICON_FILE: "/img/BetterCAD-433.png",
    CIV_VEH_MAKE_MODEL_USE_MANIFEST: "false",

    LANG_10C_BEGIN_DUTY: "10-41",
    LANG_10C_END_DUTY: "10-42",
    LANG_10C_AVAIL: "10-8",
    LANG_10C_OFF_DUTY: "10-7",
    LANG_10C_BUSY: "10-6",
    LANG_10C_ENROUTE: "10-97",
    LANG_10C_ON_SCENE: "10-23",
    LANG_10C_TRANSPORT: "10-15",
    LANG_10C_EMERGENCY_TFC: "Signal 100",
    LANG_10C_STOP_TX: "10-3"
}
