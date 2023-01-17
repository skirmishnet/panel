<?php

 namespace Pterodactyl\Listeners;

 use Pterodactyl\Models\Mount;
 use Pterodactyl\Models\MountServer;

 class RemoveMountsAfterInstallListener
 {
     /**
      * Handle the event.
      *
      * @param  object  $event
      */
     public function handle($event): void
     {
         $mounts = Mount::where('mount_on_install', '=', true)->get();
         foreach ($mounts as $mount) {
             MountServer::where('mount_id', $mount->id)->where('server_id', $event->server->id)->delete();
         }
     }
 }
