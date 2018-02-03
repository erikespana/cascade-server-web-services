<?php
function edit($auth, $identifier, $client, $newValue) {
  /* Read the asset first. */

  $readParams = array ('authentication' => $auth, 'identifier' => $identifier);
  $reply = $client->read($readParams);

  /* Then, edit the asset if read was successful */

  if ($reply->readReturn->success=='true')
  {
      // get page object
      $page = $reply->readReturn->asset->page;
      // set type field to $newValue
      $page->metadata->dynamicFields->dynamicField[5]->fieldValues->fieldValue->value= $newValue;

      // submit change(s)

      $editParams = array ('authentication' => $auth, 'asset' => array('page' => $page));
      $reply = $client->edit($editParams);

      // check status of
      if ($reply->editReturn->success=='true')
          echo "Success (edit)." . $page->id . "\n";
          //print_r($reply) . "\n";
      else
          echo "Error (edit): " . $reply->editReturn->message . "\n";
  }
  else
      echo "Error (reading): " . $reply->readReturn->message . "\n";
  //return $reply;
}
?>
