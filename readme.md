## WP Pseudo Admin

This plugins create a new WordPress role called __Ådministrator__ (note the [Å](https://en.wikipedia.org/wiki/%C3%85) character) which is the same as the usual [Editor role](http://codex.wordpress.org/Roles_and_Capabilities#Editor) plus the added ability to:

*  `list_users`
*  `edit_users`
*  `add_users`
*  `create_users`
*  `remove_users`

If [WooCommerce](http://www.woothemes.com/woocommerce/) is installed it will expand on the role of [Shop Manager](https://docs.woothemes.com/document/roles-capabilities/#section-2).

You, as the real Administrator, will still be listed in the user list, however, the new Ådministrator can’t edit you or create _real_ Administrators.

### Why?

Under this new role they’ll have all the power they need and feel like an Administrator without the dangers that come with it.

We don’t want to give clients the ability to add, disable, or delete plugins. With great power comes great responsibility and assigning the default Administrator role to a client opens up the possibility that they, intentionally or otherwise, break a site with a plugin.

## Installation

Download and include this plugin in your plugins directory, then activate it. The new role will be created and available when creating or editing a user.

### Composer

Register the repository under `repositories`…
```json
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/deadlyhifi/wp-pseudo-admin"
  }
]
```

Then add it under `require`…
```json
"require": {
  "deadlyhifi/wp-pseudo-admin": "*"
}
```

## Uninstallation

Deactivate the plugin and the role will be removed, and each assigned user will be demoted to Editor or Shop Manager.