<?php
/**
 * Get environment variables
 * @param $variable
 * @return mixed
 */
function env($variable)
{
    return $_ENV["$variable"];
}

function flash($key, $message)
{
    global $session;
    $session->getFlashBag()->add($key, $message);
}

function renderCard($title, $description, $link, $image)
{
    return <<<CARD
<div class="card card-1 my-10 mx-auto md-mx-10 col-12 md-col-4 " data-image="{$image}">
                <div class="card-content p-10">
                  <h2 class="card-title text-md mb-8">{$title}</h2>
                  <div class="card-body">
                    <p class="text-base">
                   {$description}
                    </p>
                    <a href="{$link}" target="_blank"
                       class="button py-4 px-9">View Project
                    </a>
                  </div>
                </div>
              </div>
CARD;

}
