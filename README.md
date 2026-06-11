# joostrapripped

Modernized version of a Joomla 3 template from defunct https://joostrap.com

## Origin

Once upon a time Philip Locke (not the actor) ran a web shop that produced Joomla
plugins and templates. However these were for Joomla 2 and 3, so when we upgraded our
website to Joomla 4 some features broke.

This is a modernized version that should be compatible with J4 and up.
The modernization was done with the help of Claude AI.

## Installation

Download the latest `tpl_joostrapripped-vX.Y.Z.zip` from the [Releases page](https://github.com/thoni56/joomla_template_joostrapripped/releases)
and install it via Joomla's Extension Manager (System → Install → Upload Package File).

Once installed, Joomla checks this repo for updates automatically — System → Manage → Update will
offer new versions as they are released.

## Repository layout

- `template/` — the installable extension. This is what ends up in the release zip.
- `tpl_joostrapripped-update.xml` — update manifest polled by Joomla. Rewritten by CI on every release.
- `.github/workflows/main.yml` — packages and releases on `v*` tag push.

## Releasing

1. Bump `<version>` in `template/templateDetails.xml`.
2. Commit, then `git tag vX.Y.Z` matching that version.
3. `git push && git push --tags`.

The workflow checks tag/version consistency, builds the zip, creates the GitHub Release with the zip
attached, and commits the new version + download URL into `tpl_joostrapripped-update.xml` on `main`.
