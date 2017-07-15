# config valid only for current version of Capistrano
lock "3.8.2"

set :application, "stage.culturecollide.com"
set :repo_url, "git@github.com:pandabrand/cc-wp-site.git"

# Default branch is :master
ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
set :deploy_to, "/var/www/vhosts/culturecollide.com/#{fetch(:application)}"
set :tmp_dir, "/var/www/vhosts/culturecollide.com/#{fetch(:application)}/tmp"
# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: "log/capistrano.log", color: :auto, truncate: :auto

set :log_level, :info
# Default value for :pty is false
set :pty, true

set :npm_target_path, "#{release_path}/web/app/themes/culturecollide-theme"
set :bower_target_path, "#{release_path}/web/app/themes/culturecollide-theme"
set :gulp_target_path, "#{release_path}/web/app/themes/culturecollide-theme"
set :wp_uploads, "/var/www/vhosts/culturecollide.com/#{fetch(:application)}/shared/web/app/uploads
"

set :gulp_tasks, 'sprite build'

# Default value for :linked_files is []
# set :linked_files, fetch(:linked_files, []).push('.env', 'web/.htaccess')
set :linked_files, fetch(:linked_files, []).push('.env')
set :linked_dirs, fetch(:linked_dirs, []).push('web/app/uploads')

set :composer_install_flags, '--no-interaction --optimize-autoloader --ignore-platform-reqs'

# Default value for linked_dirs is []
# append :linked_dirs, "log", "tmp/pids", "tmp/cache", "tmp/sockets", "public/system"

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for local_user is ENV['USER']
# set :local_user, -> { `git config user.name`.chomp }

# Default value for keep_releases is 5
# set :keep_releases, 5

namespace :deploy do
  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :service, :nginx, :reload
    end
  end
end

# The above restart task is not run by default
# Uncomment the following line to run it on deploys if needed
# after 'deploy:publishing', 'deploy:restart'

namespace :deploy do
  desc 'Update WordPress template root paths to point to the new release'
  task :update_option_paths do
    on roles(:app) do
      within fetch(:release_path) do
        if test :wp, :core, 'is-installed'
          [:stylesheet_root, :template_root].each do |option|
            # Only change the value if it's an absolute path
            # i.e. The relative path "/themes" must remain unchanged
            # Also, the option might not be set, in which case we leave it like that
            value = capture :wp, :option, :get, option, raise_on_non_zero_exit: false
            if value != '' && value != '/themes'
              execute :wp, :option, :set, option, fetch(:release_path).join('web/wp/wp-content/themes')
            end
          end
        end
      end
    end
  end
end
